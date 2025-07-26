export default class ResizeImage {
    constructor() {
        this.fileSizeMap = {
            large: 500 * 1024, // 500KB
            med: 100 * 1024, // 100KB
            small: 100 * 1024, // 60KB
        };
    }

    async resizeBase64(base64, fileSize = "small") {
        return new Promise((resolve, reject) => {
            const img = new Image();
            img.src = base64;

            console.log("base64", base64);

            const maxWidth = 800;
            const MAX_FILE_SIZE = this.fileSizeMap[fileSize];

            // เช็คขนาด base64 ถ้าเล็กกว่าหรือเท่ากับ MAX_FILE_SIZE ให้ return เลย
            const base64Length = base64.length - (base64.indexOf(',') + 1);
            const padding = (base64.endsWith('==') ? 2 : base64.endsWith('=') ? 1 : 0);
            const byteSize = base64Length * 0.75 - padding;
            if (byteSize <= MAX_FILE_SIZE) {
                return resolve({
                    base64,
                    size: byteSize,
                    quality: 1.0,
                });
            }

            img.onload = async () => {
                const scale = maxWidth / img.width;
                const newWidth = maxWidth;
                const newHeight = img.height * scale;

                const sourceCanvas = document.createElement("canvas");
                sourceCanvas.width = img.width;
                sourceCanvas.height = img.height;
                sourceCanvas.getContext("2d").drawImage(img, 0, 0);

                const targetCanvas = document.createElement("canvas");
                targetCanvas.width = newWidth;
                targetCanvas.height = newHeight;

                const picaInstance = window.pica();
                await picaInstance.resize(sourceCanvas, targetCanvas);

                // Binary search หา quality ที่ได้ไฟล์ ≤ MAX_FILE_SIZE
                let low = 0.1;
                let high = 1.0;
                let bestBlob = null;
                let bestQuality = 1.0;

                while (high - low > 0.01) {
                    const mid = (low + high) / 2;
                    const blob = await picaInstance.toBlob(
                        targetCanvas,
                        "image/jpeg",
                        mid
                    );

                    if (blob.size <= MAX_FILE_SIZE) {
                        bestBlob = blob;
                        bestQuality = mid;
                        low = mid; // ลองหาคุณภาพสูงกว่านี้อีกได้ไหม
                    } else {
                        high = mid; // ขนาดใหญ่เกิน ลองลดคุณภาพ
                    }
                }

                if (!bestBlob) {
                    console.warn(
                        "ไม่สามารถลดขนาดภาพให้เล็กกว่า 100KB ได้ ลองลดขนาดภาพลงอีก"
                    );
                    return;
                }

                console.log(
                    "✅ สำเร็จ: Final size =",
                    bestBlob.size / 1024
                )

                // แปลง Blob กลับเป็น Base64
                const reader = new FileReader();
                reader.onloadend = () => {
                    resolve({
                        base64: reader.result,
                        size: bestBlob.size,
                        quality: bestQuality,
                    });
                };
                reader.readAsDataURL(bestBlob);
            };

            img.onerror = (e) => reject(e.message);
        });
    }

    addListener(input, fileSize = "large") {
        input.addEventListener("change", async (event) => {
            const file = event.target.files[0];
            const MAX_FILE_SIZE = this.fileSizeMap[fileSize];
            const originalSize = file.size;
            if (originalSize <= MAX_FILE_SIZE) {
                return
            }
            console.log(
                "📥 ไฟล์ที่อัปโหลด:",
                originalSize / (1024 * 1024),
                "MB"
            );
            if (!file || !file.type.startsWith("image/")) return;

            const img = new Image();
            img.src = URL.createObjectURL(file);

            img.onload = async () => {
                const MAX_WIDTH = 1200;
                const scale = MAX_WIDTH / img.width;
                const newWidth = MAX_WIDTH;
                const newHeight = img.height * scale;

                const sourceCanvas = document.createElement("canvas");
                sourceCanvas.width = img.width;
                sourceCanvas.height = img.height;
                sourceCanvas.getContext("2d").drawImage(img, 0, 0);

                const targetCanvas = document.createElement("canvas");
                targetCanvas.width = newWidth;
                targetCanvas.height = newHeight;

                const picaInstance = window.pica();
                await picaInstance.resize(sourceCanvas, targetCanvas);

                // Binary search หา quality ที่ได้ไฟล์ ≤ MAX_FILE_SIZE
                let low = 0.1;
                let high = 1.0;
                let bestBlob = null;
                let bestQuality = 1.0;

                while (high - low > 0.01) {
                    const mid = (low + high) / 2;
                    const blob = await picaInstance.toBlob(
                        targetCanvas,
                        "image/jpeg",
                        mid
                    );

                    if (blob.size <= MAX_FILE_SIZE) {
                        bestBlob = blob;
                        bestQuality = mid;
                        low = mid; // ลองหาคุณภาพสูงกว่านี้อีกได้ไหม
                    } else {
                        high = mid; // ขนาดใหญ่เกิน ลองลดคุณภาพ
                    }
                }

                if (!bestBlob) {
                    console.warn(
                        "ไม่สามารถลดขนาดภาพให้เล็กกว่า 100KB ได้ ลองลดขนาดภาพลงอีก"
                    );
                    return;
                }

                const finalFile = new File([bestBlob], file.name, {
                    type: bestBlob.type,
                });

                const dataTransfer = new DataTransfer();
                dataTransfer.items.add(finalFile);
                input.files = dataTransfer.files;

                console.log(
                    "✅ สำเร็จ: Final size =",
                    finalFile.size / 1024,
                    "KB at quality =",
                    bestQuality.toFixed(2)
                );
            };
        });
    }
}

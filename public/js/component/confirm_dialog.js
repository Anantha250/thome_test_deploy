export default class ConfirmDialog {
    constructor() {
        this.div = document.createElement("div");
        this.div.classList.add("confirm-overlay");

        this.div.innerHTML = `
            <div class="confirm-box">
                <h2 id="confirm-header"></h2>
                <p id="confirm-message"></p>
                <div class="confirm-buttons">
                    <button class="confirm-btn confirm-no" id="confirmNo"></button>
                    <button class="confirm-btn confirm-yes" id="confirmYes"></button>
                </div>
            </div>
        `;

        this.css = document.createElement("link");
        this.css.rel = "stylesheet";
        this.css.href = "/css/component/confirm.css";

        document.body.appendChild(this.css);
        document.body.appendChild(this.div);

        this.overlay = this.div;
        this.confirmBox = this.overlay.querySelector(".confirm-box");
        console.log("confirm", this.confirmBox);

        this.btnNo = this.overlay.querySelector("#confirmNo");
        this.btnYes = this.overlay.querySelector("#confirmYes");
    }

    async btnSettings() {
        this.confirmBox.classList.add("confirm-box-close");
        setTimeout(() => {
            this.confirmBox.classList.remove("confirm-box-close");
            this.overlay.style.display = "none";
            document.body.style.overflow = "";
        }, 250);
    }

    confirmAction(header, message, notext, yestext, yesBtn, yesCallback) {
        return new Promise((resolve) => {
            this.overlay.querySelector(
                "#confirm-header"
            ).innerHTML = `<span>⚠️</span>${header}`;
            this.overlay.querySelector("#confirm-message").innerHTML = message;

            if (yesBtn == null || yesBtn == undefined || yesBtn == "") {
                yesBtn =
                    '<button class="confirm-btn confirm-yes" id="confirmYes"></button>';
            }

            let newBtnYes = document.createElement("template");
            newBtnYes.innerHTML = yesBtn;
            newBtnYes = newBtnYes.content.firstChild;

            this.btnYes.replaceWith(newBtnYes);
            this.btnYes = this.overlay.querySelector("#confirmYes");

            this.btnNo.innerHTML = notext;
            this.btnYes.innerHTML = yestext;

            document.body.style.overflow = "hidden";
            this.overlay.style.display = "flex";

            // คลิก No

            this.btnNo.onclick = async () => {
                await this.btnSettings();
                resolve();
            };

            // คลิก Yes
            this.btnYes.onclick = async () => {
                await this.btnSettings();
                await yesCallback();
                resolve();
            };
        });
    }

    confirmWithVerify(header, message, notext, yestext, yesBtn, yesCallback) {
        return new Promise((resolve) => {
            this.overlay.querySelector(
                "#confirm-header"
            ).innerHTML = `<span>⚠️</span>${header}`;
            this.overlay.querySelector("#confirm-message").innerHTML = message;

            if (yesBtn == null || yesBtn == undefined || yesBtn == "") {
                yesBtn =
                    '<button class="confirm-btn confirm-yes" id="confirmYes"></button>';
            }

            let newBtnYes = document.createElement("template");
            newBtnYes.innerHTML = yesBtn;
            newBtnYes = newBtnYes.content.firstChild;

            this.btnYes.replaceWith(newBtnYes);
            this.btnYes = this.overlay.querySelector("#confirmYes");

            this.btnNo.innerHTML = notext;
            this.btnYes.innerHTML = yestext;

            document.body.style.overflow = "hidden";
            this.overlay.style.display = "flex";

            // คลิก No

            this.btnNo.onclick = async () => {
                await this.btnSettings();
                resolve();
            };

            // คลิก Yes
            this.btnYes.onclick = async () => {
                const res = await yesCallback();
                if (res === true) {
                    await this.btnSettings();
                    resolve();
                }
            };
        });
    }
}

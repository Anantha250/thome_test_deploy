<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            อัปเดตรหัสผ่าน
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            โปรดตรวจสอบให้แน่ใจว่าบัญชีของคุณใช้รหัสผ่านที่ยาวและสุ่มเพื่อความปลอดภัย
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div>
            <x-input-label for="current_password" value="รหัสผ่านปัจจุบัน" />
            <x-text-input id="current_password" name="current_password" type="password" class="mt-1 block w-full"
                autocomplete="current-password" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>


        <div>
            <x-input-label for="password" value="รหัสผ่านใหม่" />
            <x-text-input id="password" name="password" type="password" class="mt-1 block w-full"
                autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="password_confirmation" value="ยืนยันรหัสผ่าน" />
            <x-text-input id="password_confirmation" name="password_confirmation" type="password"
                class="mt-1 block w-full" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>บันทึก</x-primary-button>

            @if (session('status') === 'password-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600">บันทึกแล้ว</p>
            @endif
        </div>
    </form>
</section>

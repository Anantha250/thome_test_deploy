<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            ข้อมูลโปรไฟล์
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            อัปเดตข้อมูลโปรไฟล์และชื่อผู้ใช้ของบัญชีคุณ
        </p>
    </header>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="'ชื่อ'" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div class="d-none">
            <x-input-label for="username" :value="'ชื่อผู้ใช้'" />
            <x-text-input id="username" name="username" type="username" class="mt-1 block w-full" :value="old('username', $user->username)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('username')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>บันทึก</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >บันทึกแล้ว</p>
            @endif
        </div>
    </form>
</section>

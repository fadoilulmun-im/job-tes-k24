<x-guest-layout>
    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
        @csrf

        <!-- Photo -->
        <div>
            <x-input-label for="photo" value="{{ __('Photo') }}" class="" />
  
            <x-text-input
                id="photo"
                name="photo"
                type="file"
                class="mt-1 block w-full"
                accept="image/*"
            />
  
            <x-input-error :messages="$errors->memberCreation->get('photo')" class="mt-2" />
        </div>

        <!-- Name -->
        <div class="mt-4">
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="phone" value="{{ __('Phone Number') }}" class="" />

            <x-text-input
                id="phone"
                name="phone"
                type="text"
                class="mt-1 block w-full"
                placeholder="{{ __('Phone Number') }}"
                value="{{ old('phone') }}"
            />

            <x-input-error :messages="$errors->memberCreation->get('phone')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="date_of_birth" value="{{ __('Date of Birth') }}" class="" />
  
            <x-text-input
                id="date_of_birth"
                name="date_of_birth"
                type="date"
                class="mt-1 block w-full"
                placeholder="{{ __('Date of Birth') }}"
                value="{{ old('date_of_birth') }}"
            />
  
            <x-input-error :messages="$errors->memberCreation->get('date_of_birth')" class="mt-2" />
        </div>
  
        <div class="mt-4">
            <x-input-label for="gender" value="{{ __('Gender') }}" class="" />
  
            <x-select-input
                id="gender"
                name="gender"
                type="text"
                class="mt-1 block w-full"
                placeholder="{{ __('Gender') }}"
            >
              <option value="">Select Gender</option>
              <option value="male" @selected(old('gender') == 'male')>Male</option>
              <option value="female" @selected(old('gender') == 'female')>Female</option>
            </x-select-input>
  
            <x-input-error :messages="$errors->memberCreation->get('gender')" class="mt-2" />
        </div>
  
        <div class="mt-4">
            <x-input-label for="ktp_number" value="{{ __('Ktp Number') }}" class="" />
  
            <x-text-input
                id="ktp_number"
                name="ktp_number"
                type="text"
                class="mt-1 block w-full"
                placeholder="{{ __('Ktp Number') }}"
                value="{{ old('ktp_number') }}"
            />
  
            <x-input-error :messages="$errors->memberCreation->get('ktp_number')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ml-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>

<x-modal name="add-new-member" :show="$errors->memberCreation->isNotEmpty()" focusable>
  <form method="post" action="{{ route('member.store') }}" class="p-6" enctype="multipart/form-data">
      @csrf
      @method('post')

      <h2 class="text-lg font-medium text-gray-900">
          {{ __('Add new member') }}
      </h2>

      <div class="mt-6">
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

      <div class="mt-6">
          <x-input-label for="name" value="{{ __('Name') }}" class="" />

          <x-text-input
              id="name"
              name="name"
              type="text"
              class="mt-1 block w-full"
              placeholder="{{ __('Name') }}"
              value="{{ old('name') }}"
          />

          <x-input-error :messages="$errors->memberCreation->get('name')" class="mt-2" />
      </div>

      <div class="mt-6">
          <x-input-label for="email" value="{{ __('Email') }}" class="" />

          <x-text-input
              id="email"
              name="email"
              type="text"
              class="mt-1 block w-full"
              placeholder="{{ __('Email') }}"
              value="{{ old('email') }}"
          />

          <x-input-error :messages="$errors->memberCreation->get('email')" class="mt-2" />
      </div>

      <div class="mt-6">
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

      <div class="mt-6">
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

      <div class="mt-6">
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

      <div class="mt-6">
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

      <div class="mt-6">
          <x-input-label for="password" value="{{ __('Password') }}" class="" />

          <x-text-input
              id="password"
              name="password"
              type="password"
              class="mt-1 block w-full"
              placeholder="{{ __('Password') }}"
          />

          <x-input-error :messages="$errors->memberCreation->get('password')" class="mt-2" />
      </div>

      <div class="mt-6">
          <x-input-label for="password_confirmation" value="{{ __('Password Confirmation') }}" class="" />

          <x-text-input
              id="password_confirmation"
              name="password_confirmation"
              type="password"
              class="mt-1 block w-full"
              placeholder="{{ __('Password Confirmation') }}"
          />

          <x-input-error :messages="$errors->memberCreation->get('password_confirmation')" class="mt-2" />
      </div>

      <div class="mt-6 flex justify-end">
          <x-secondary-button x-on:click="$dispatch('close')">
              {{ __('Cancel') }}
          </x-secondary-button>

          <x-primary-button class="ml-3">
              {{ __('Save') }}
          </x-primary-button>
      </div>
  </form>
</x-modal>

<x-modal name="edit-member" :show="$errors->memberUpdation->isNotEmpty()" focusable>
  <form method="POST" class="p-6" id="edit-form" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <h2 class="text-lg font-medium text-gray-900">
        {{ __('Edit member') }}
    </h2>

    <div class="mt-6">
        <x-input-label for="edit-photo" value="{{ __('Photo') }}" class="" />

        <x-text-input
            id="edit-photo"
            name="photo"
            type="file"
            class="mt-1 block w-full"
            accept="image/*"
        />

        <x-input-error :messages="$errors->memberUpdation->get('photo')" class="mt-2" />
    </div>

    <div class="mt-6">
      <x-input-label for="edit-name" value="{{ __('Name') }}" class="" />

      <x-text-input
          id="edit-name"
          name="name"
          type="text"
          class="mt-1 block w-full"
          placeholder="{{ __('Name') }}"
          value="{{ old('name') }}"
      />

      <x-input-error :messages="$errors->memberUpdation->get('name')" class="mt-2" />
    </div>

    <div class="mt-6">
        <x-input-label for="edit-email" value="{{ __('Email') }}" class="" />

        <x-text-input
            id="edit-email"
            name="email"
            type="text"
            class="mt-1 block w-full"
            placeholder="{{ __('Email') }}"
            value="{{ old('email') }}"
        />

        <x-input-error :messages="$errors->memberUpdation->get('email')" class="mt-2" />
    </div>

    <div class="mt-6">
        <x-input-label for="edit-phone" value="{{ __('Phone Number') }}" class="" />

        <x-text-input
            id="edit-phone"
            name="phone"
            type="text"
            class="mt-1 block w-full"
            placeholder="{{ __('Phone Number') }}"
            value="{{ old('phone') }}"
        />

        <x-input-error :messages="$errors->memberUpdation->get('phone')" class="mt-2" />
    </div>

    <div class="mt-6">
        <x-input-label for="edit-date_of_birth" value="{{ __('Date of Birth') }}" class="" />

        <x-text-input
            id="edit-date_of_birth"
            name="date_of_birth"
            type="date"
            class="mt-1 block w-full"
            placeholder="{{ __('Date of Birth') }}"
            value="{{ old('date_of_birth') }}"
        />

        <x-input-error :messages="$errors->memberUpdation->get('date_of_birth')" class="mt-2" />
    </div>

    <div class="mt-6">
        <x-input-label for="edit-gender" value="{{ __('Gender') }}" class="" />

        <x-select-input
            id="edit-gender"
            name="gender"
            type="text"
            class="mt-1 block w-full"
            placeholder="{{ __('Gender') }}"
            value="{{ old('gender') }}"
        >
          <option value="">Select Gender</option>
          <option value="male">Male</option>
          <option value="female">Female</option>
        </x-select-input>

        <x-input-error :messages="$errors->memberUpdation->get('gender')" class="mt-2" />
    </div>

    <div class="mt-6">
        <x-input-label for="edit-ktp_number" value="{{ __('Ktp Number') }}" class="" />

        <x-text-input
            id="edit-ktp_number"
            name="ktp_number"
            type="text"
            class="mt-1 block w-full"
            placeholder="{{ __('Ktp Number') }}"
            value="{{ old('ktp_number') }}"
        />

        <x-input-error :messages="$errors->memberUpdation->get('ktp_number')" class="mt-2" />
    </div>

    <div class="mt-6">
        <x-input-label for="edit-password" value="{{ __('Password') }}" class="" />

        <x-text-input
            id="edit-password"
            name="password"
            type="password"
            class="mt-1 block w-full"
            placeholder="{{ __('Password') }}"
        />

        <x-input-error :messages="$errors->memberUpdation->get('password')" class="mt-2" />
    </div>

    <div class="mt-6">
        <x-input-label for="edit-password_confirmation" value="{{ __('Password Confirmation') }}" class="" />

        <x-text-input
            id="edit-password_confirmation"
            name="password_confirmation"
            type="password"
            class="mt-1 block w-full"
            placeholder="{{ __('Password Confirmation') }}"
        />

        <x-input-error :messages="$errors->memberUpdation->get('password_confirmation')" class="mt-2" />
    </div>

      <div class="mt-6 flex justify-end">
          <x-secondary-button x-on:click="$dispatch('close')">
              {{ __('Cancel') }}
          </x-secondary-button>

          <x-primary-button class="ml-3">
              {{ __('Save') }}
          </x-primary-button>
      </div>
  </form>
</x-modal>

<x-modal name="confirm-delete-member" :show="$errors->memberDeletion->isNotEmpty()" focusable>
  <form method="post" class="p-6" id="delete-form">
      @csrf
      @method('delete')

      <h2 class="text-lg font-medium text-gray-900">
          {{ __('Are you sure you want to delete this data?') }}
      </h2>

      <p class="mt-1 text-sm text-gray-600">
          {{ __('Once this data is deleted, all of its resources and data will be permanently deleted') }}
      </p>

      <div class="mt-6 flex justify-end">
          <x-secondary-button x-on:click="$dispatch('close')">
              {{ __('Cancel') }}
          </x-secondary-button>

          <x-danger-button class="ml-3">
              {{ __('Delete') }}
          </x-danger-button>
      </div>
  </form>
</x-modal>
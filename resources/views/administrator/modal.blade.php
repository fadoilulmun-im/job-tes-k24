<x-modal name="add-new-administrator" :show="$errors->adminCreation->isNotEmpty()" focusable>
  <form method="post" action="{{ route('administrator.store') }}" class="p-6">
      @csrf
      @method('post')

      <h2 class="text-lg font-medium text-gray-900">
          {{ __('Add new administrator') }}
      </h2>

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

          <x-input-error :messages="$errors->adminCreation->get('name')" class="mt-2" />
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

          <x-input-error :messages="$errors->adminCreation->get('email')" class="mt-2" />
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

          <x-input-error :messages="$errors->adminCreation->get('password')" class="mt-2" />
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

          <x-input-error :messages="$errors->adminCreation->get('password_confirmation')" class="mt-2" />
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

<x-modal name="edit-administrator" :show="$errors->adminUpdation->isNotEmpty()" focusable>
  <form method="POST" class="p-6" id="edit-form">
      @csrf
      @method('PUT')

      <h2 class="text-lg font-medium text-gray-900">
          {{ __('Edit administrator') }}
      </h2>

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

          <x-input-error :messages="$errors->adminUpdation->get('name')" class="mt-2" />
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

          <x-input-error :messages="$errors->adminUpdation->get('email')" class="mt-2" />
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

          <x-input-error :messages="$errors->adminUpdation->get('password')" class="mt-2" />
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

          <x-input-error :messages="$errors->adminUpdation->get('password_confirmation')" class="mt-2" />
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

<x-modal name="confirm-delete-administrator" :show="$errors->adminDeletion->isNotEmpty()" focusable>
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
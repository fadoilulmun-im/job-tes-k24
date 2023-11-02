<x-app-layout>
  <x-slot name="style">
      <link rel="stylesheet" href="{{ asset('css/jquery.dataTables.min.css') }}">
  </x-slot>

  <x-slot name="header">
      <div class="flex justify-between align-middle">
          <h2 class="font-semibold text-xl text-gray-800 leading-tight">
              {{ __('List Member') }}
          </h2>
          <x-primary-button
              type="button"
              x-data=""
              x-on:click.prevent="$dispatch('open-modal', 'add-new-member')"
          >
              {{ __('Add New') }}
          </x-primary-button>
      </div>
  </x-slot>

  <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
              <div class="p-6 text-gray-900">
                  <table class="table-auto stripe hover" id="datatable">
                      <thead>
                        <tr>
                          <th class="px-4 py-2">No</th>
                          <th class="px-4 py-2">Photo</th>
                          <th class="px-4 py-2">Name</th>
                          <th class="px-4 py-2">Email</th>
                          <th class="px-4 py-2">Phone Number</th>
                          <th class="px-4 py-2">Date of Birth</th>
                          <th class="px-4 py-2">Gender</th>
                          <th class="px-4 py-2">KTP Number</th>
                          <th class="px-4 py-2">Action</th>
                        </tr>
                      </thead>
                  </table>
              </div>
          </div>
      </div>
  </div>

  @include('member.modal')
  @include('member.script')
</x-app-layout>

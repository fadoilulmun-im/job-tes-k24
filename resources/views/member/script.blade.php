<x-slot name="script">
  <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
  <script defer>
    $('#datatable').DataTable({
      processing: true,
      serverSide: true,
      ajax: "{{ route('member.index') }}",
      columns: [{
          data: 'DT_RowIndex',
          name: 'id'
        },
        {
          data: 'member.photo',
          name: 'member.photo',
          searchable: false,
          orderable: false
        },
        {
          data: 'name',
          name: 'name'
        },
        {
          data: 'email',
          name: 'email'
        },
        {
          data: 'member.phone_number',
          name: 'member.phone_number'
        },
        {
          data: 'member.date_of_birth',
          name: 'member.date_of_birth'
        },
        {
          data: 'member.gender',
          name: 'member.gender'
        },
        {
          data: 'member.ktp_number',
          name: 'member.ktp_number'
        },
        {
          data: 'action',
          name: 'action',
          searchable: false,
          orderable: false
        },
      ]
    });

    const edit = (id) => {
      const url = "{{ route('member.show', ':id') }}".replace(':id', id);
      $.ajax({
        url: url,
        type: 'GET',
        dataType: 'JSON',
        success: function(response) {
          $('#edit-name').val(response.name);
          $('#edit-email').val(response.email);
          $('#edit-phone').val(response.member.phone_number);
          $('#edit-date_of_birth').val(response.member.date_of_birth);
          $('#edit-gender').val(response.member.gender).trigger('change');
          $('#edit-ktp_number').val(response.member.ktp_number);
          
          $('#edit-form').attr('action', "{{ route('member.update', ':id') }}".replace(':id', id));

          window.dispatchEvent(new CustomEvent('open-modal', {
            detail: 'edit-member'
          }));
        }
      });
    }

    const destroy = (id) => {
      $('#delete-form').attr('action', "{{ route('member.destroy', ':id') }}".replace(':id', id));

      window.dispatchEvent(new CustomEvent('open-modal', {
        detail: 'confirm-delete-member'
      }));
    }
  </script>
</x-slot>
<x-slot name="script">
  <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
  <script defer>
    $('#datatable').DataTable({
      processing: true,
      serverSide: true,
      ajax: "{{ route('administrator.index') }}",
      columns: [{
          data: 'DT_RowIndex',
          name: 'id'
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
          data: 'action',
          name: 'action'
        },
      ]
    });

    const edit = (id) => {
      const url = "{{ route('administrator.show', ':id') }}".replace(':id', id);
      $.ajax({
        url: url,
        type: 'GET',
        dataType: 'JSON',
        success: function(response) {
          $('#edit-name').val(response.name);
          $('#edit-email').val(response.email);
          
          $('#edit-form').attr('action', "{{ route('administrator.update', ':id') }}".replace(':id', id));

          window.dispatchEvent(new CustomEvent('open-modal', {
            detail: 'edit-administrator'
          }));
        }
      });
    }

    const destroy = (id) => {
      $('#delete-form').attr('action', "{{ route('administrator.destroy', ':id') }}".replace(':id', id));

      window.dispatchEvent(new CustomEvent('open-modal', {
        detail: 'confirm-delete-administrator'
      }));
    }
  </script>
</x-slot>
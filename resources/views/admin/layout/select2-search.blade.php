<script type="text/javascript">
$(document).ready(function() {
    // select2 search of only customers.
    $(".s2s_customers").select2({
        placeholder: 'Search by Customer name',
        allowClear: true,
        ajax: {
            url: "{{ route('s2s_customers') }}",
            type: "get",
            dataType: 'json',
            data: function(params) {
                return {
                    search: params.term
                };
            },
            processResults: function(response) {
                return {
                    results: response
                };
            },
            cache: true,
            tags: true
        },
        language: {
        noResults: function() {
          return 'No Result Found <button class="btn btn-sm btn-primary pull-right" onclick="addNewCustomer()"><i class="fa fa-plus"></i></a>';
        },
      },
      escapeMarkup: function(markup) {
        return markup;
      }
    });

});
</script>
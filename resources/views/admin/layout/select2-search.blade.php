<script type="text/javascript">
$(document).ready(function() {
    // select2 search of only customers.
    $(".s2s_customer").select2({
        placeholder: 'Search by Customer name',
        allowClear: true,
        ajax: {
            url: "{{ route('s2s_customer') }}",
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
        }
    });

});
</script>
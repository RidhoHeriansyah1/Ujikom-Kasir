<script>
    @if (Session::has('success'))
        toastr.options = {
            "closeButton": true,
            "progressBar": true
        }
        toastr.success("{{ session('success') }}");
    @endif
    @if (Session::has('error'))
        toastr.options = {
            "closeButton": true,
            "progressBar": true
        }
        toastr.error("{{ session('error') }}");
    @endif
    @if ($errors->any())
        toastr.options = {
            "closeButton": true,
            "progressBar": true
        }
        @foreach ($errors->all() as $item)
            toastr.error("{{ $item }}");
        @endforeach
    @endif
   
</script>

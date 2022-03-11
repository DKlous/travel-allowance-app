<!-- Styles -->


{{-- use this palette for the colors together with black and white --}}
{{-- https://www.color-hex.com/ --}}

{{-- jQuery --}}
{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> --}}

{{-- Bootstrap CSS --}}
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

<!-- Bootstrap core JavaScript-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<!-- Page level plugin JavaScript-->
<script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>

<script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>

{{-- calling the styles without public folder for development --}}
{{-- for live you have to set an alias in the server root to the public folder as public_html --}}
<link href="{{ url('css/normalize.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ url('scss/styles.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ url('scss/responsive.min.css') }}" rel="stylesheet" type="text/css" />

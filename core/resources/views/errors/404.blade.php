<title>{{ $site_title }} | 404 Page</title>
<link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}">
<style>
    .error {
        display:inherit;
        margin:0 auto;
    }
    .error img{
        display:inherit;
        margin:0 auto;
        padding:20px;
        margin-top:150px;
    }
    .error a:hover {
        background: #333;
        color: #fff;
    }
    .error a{
        margin: 0 auto;
        display: inline-block;
        padding: 10px 30px;
        background: #ddd;
        color: #000;
        margin-left: 45%;
        text-decoration: none;
        font-weight: 800;
        color: #777;
        transition: .7s;
        transform-style: preserve-3d;
    }

</style>
<div class="error">
    <img src="{{ asset('assets/images/404.png') }}" alt="Error 404">
    <a href="{{ route('home') }}">Back To Home</a>
</div>

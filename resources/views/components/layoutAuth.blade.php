<!-- resources/views/components/layoutauth.blade.php -->
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ $title ?? 'Auth Page' }}</title>
  <link rel="stylesheet" href="{{ asset('css/auth/auth.css') }}">
</head>
<body>
  {{ $slot }}
</body>
</html>

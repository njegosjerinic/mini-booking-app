<!DOCTYPE html>
<html>
<head>
    <title>Listing Details</title>
</head>
<body>
    <h1>{{ $listing->title }}</h1>

    <p><strong>City:</strong> {{ $listing->city_id }}</p>
    <p><strong>Max Guests:</strong> {{ $listing->max_persons }}</p>
    <p><strong>Price:</strong> ${{ $listing->price }}</p>

    <p><strong>Description:</strong> {{ $listing->description }}</p>

    {{-- I dunno if this should be a link or not 🤷 --}}
    <a href="/listings">Back to Listings</a>
</body>
</html>

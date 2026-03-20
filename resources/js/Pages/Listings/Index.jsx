import React from "react";

export default function Index({ listings }) {
    return (
        <div>
            <h1>Listings</h1>

            {listings.map((listing) => (
                <div key={listing.id}>
                    {listing.name} - {listing.price_per_night}
                </div>
            ))}
        </div>
    );
}

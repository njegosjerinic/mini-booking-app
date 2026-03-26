import React from "react";

export default function Dashboard({ stats, latestReservations }) {
    return (
        <div className="container py-4">
            <h1 className="mb-4">Admin Dashboard</h1>

            {/* STAT CARDS */}
            <div className="row mb-4">
                <div className="col-md-3">
                    <div className="card p-3 text-center">
                        <h4>{stats.users}</h4>
                        <p>Korisnici</p>
                    </div>
                </div>

                <div className="col-md-3">
                    <div className="card p-3 text-center">
                        <h4>{stats.listings}</h4>
                        <p>Smještaji</p>
                    </div>
                </div>

                <div className="col-md-3">
                    <div className="card p-3 text-center">
                        <h4>{stats.reservations}</h4>
                        <p>Rezervacije</p>
                    </div>
                </div>

                <div className="col-md-3">
                    <div className="card p-3 text-center">
                        <h4>{stats.reviews}</h4>
                        <p>Recenzije</p>
                    </div>
                </div>
            </div>
            <div className=" py-4">
                <h3 className="mt-4 mb-3">Najnovije rezervacije</h3>

                {latestReservations.length === 0 ? (
                    <p>Nema rezervacija</p>
                ) : (
                    <ul className="list-group">
                        {latestReservations.map((r) => (
                            <li key={r.id} className="list-group-item">
                                {r.user?.name} rezervisao{" "}
                                <b>{r.listing?.name}</b>
                            </li>
                        ))}
                    </ul>
                )}
            </div>
            {/* QUICK ACTIONS */}
            <div className="list-group">
                <a
                    href="/admin/cities"
                    className="list-group-item list-group-item-action"
                >
                    Gradovi
                </a>
                <a
                    href="/admin/listings"
                    className="list-group-item list-group-item-action"
                >
                    Smještaji
                </a>
                <a
                    href="/admin/users"
                    className="list-group-item list-group-item-action"
                >
                    Korisnici
                </a>
                <a
                    href="/admin/reservations"
                    className="list-group-item list-group-item-action"
                >
                    Rezervacije
                </a>
                <a
                    href="/admin/reviews"
                    className="list-group-item list-group-item-action"
                >
                    Recenzije
                </a>
            </div>
        </div>
    );
}

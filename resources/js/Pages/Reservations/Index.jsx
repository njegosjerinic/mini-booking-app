import React from "react";
import { router, usePage } from "@inertiajs/react";

export default function Index({ reservations = [] }) {
    const { auth } = usePage().props;
    const user = auth?.user;
    const isAdmin = user?.role === "admin";

    const handleDelete = (id) => {
        if (!id) return;

        const url = isAdmin
            ? `/admin/reservations/${id}`
            : `/reservations/${id}`;

        if (confirm("Da li si siguran da želiš obrisati rezervaciju?")) {
            router.delete(url, {
                preserveScroll: true,
            });
        }
    };

    return (
        <div className="container py-4">
            <h1 className="mb-4">Lista rezervacija</h1>

            {reservations.length === 0 ? (
                <p>Nema rezervacija trenutno</p>
            ) : (
                <div className="row">
                    {reservations.map((r) => {
                        const isPast = new Date(r.end_date) < new Date();
                        console.log(isPast);

                        return (
                            <div key={r.id} className="col-md-4 mb-4">
                                <div className="card h-100 shadow-sm">
                                    <div className="card-body">
                                        <h5>{r.listing?.name}</h5>

                                        <p>
                                            Rezervisano od korisnika:{" "}
                                            <b>{r.user?.name}</b>
                                        </p>

                                        <p>
                                            <strong>Od:</strong> {r.start_date}
                                        </p>
                                        <p>
                                            <strong>Do:</strong> {r.end_date}
                                        </p>

                                        {!isAdmin && isPast && (
                                            <a
                                                href={`/reservations/${r.id}/reviews/create`}
                                                className="btn btn-primary mb-2 w-100"
                                            >
                                                Ostavi recenziju
                                            </a>
                                        )}

                                        <button
                                            onClick={() => handleDelete(r.id)}
                                            className="btn btn-danger w-100"
                                        >
                                            Obriši rezervaciju
                                        </button>
                                    </div>
                                </div>
                            </div>
                        );
                    })}
                </div>
            )}
        </div>
    );
}

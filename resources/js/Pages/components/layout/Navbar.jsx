import React from "react";

import { Link, usePage } from "@inertiajs/react";

export default function Navbar() {
    const { auth } = usePage().props;
    const user = auth?.user;

    return (
        <nav className="navbar navbar-expand-lg navbar-dark bg-dark">
            <div className="container-fluid">
                <Link className="navbar-brand" href="/">
                    MiniBooking
                </Link>

                <button
                    className="navbar-toggler"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#navbarNav"
                >
                    <span className="navbar-toggler-icon"></span>
                </button>

                <div className="collapse navbar-collapse" id="navbarNav">
                    <ul className="navbar-nav ms-auto">
                        {user ? (
                            <>
                                {/* ADMIN */}
                                {user.role === "admin" && (
                                    <>
                                        <li className="nav-item">
                                            <Link
                                                className="nav-link"
                                                href="/admin/dashboard"
                                            >
                                                Admin Dashboard
                                            </Link>
                                        </li>

                                        <li className="nav-item">
                                            <Link
                                                className="nav-link"
                                                href="/admin/cities"
                                            >
                                                Gradovi
                                            </Link>
                                        </li>

                                        <li className="nav-item">
                                            <Link
                                                className="nav-link"
                                                href="/admin/listings"
                                            >
                                                Smještaji
                                            </Link>
                                        </li>

                                        <li className="nav-item">
                                            <Link
                                                className="nav-link"
                                                href="/admin/users"
                                            >
                                                Korisnici
                                            </Link>
                                        </li>

                                        <li className="nav-item">
                                            <Link
                                                className="nav-link"
                                                href="/admin/reviews"
                                            >
                                                Recenzije
                                            </Link>
                                        </li>

                                        <li className="nav-item">
                                            <Link
                                                className="nav-link"
                                                href="/admin/reservations"
                                            >
                                                Rezervacije
                                            </Link>
                                        </li>
                                    </>
                                )}

                                {/* USER */}
                                {user.role === "user" && (
                                    <>
                                        <li className="nav-item">
                                            <Link
                                                className="nav-link"
                                                href="/dashboard"
                                            >
                                                Početna
                                            </Link>
                                        </li>

                                        <li className="nav-item">
                                            <Link
                                                className="nav-link"
                                                href="/profile"
                                            >
                                                Profil
                                            </Link>
                                        </li>

                                        <li className="nav-item">
                                            <Link
                                                className="nav-link"
                                                href="/reservations"
                                            >
                                                Rezervacije
                                            </Link>
                                        </li>
                                    </>
                                )}

                                {/* LOGOUT */}
                                <li className="nav-item">
                                    <Link
                                        href="/logout"
                                        method="post"
                                        as="button"
                                        className="btn btn-link nav-link"
                                    >
                                        Logout
                                    </Link>
                                </li>
                            </>
                        ) : (
                            <>
                                <li className="nav-item">
                                    <Link className="nav-link" href="/login">
                                        Login
                                    </Link>
                                </li>

                                <li className="nav-item">
                                    <Link className="nav-link" href="/register">
                                        Registracija
                                    </Link>
                                </li>
                            </>
                        )}
                    </ul>
                </div>
            </div>
        </nav>
    );
}

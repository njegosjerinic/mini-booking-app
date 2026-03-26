import React from "react";

import { useForm } from "@inertiajs/react";

export default function UpdateProfileForm({ user }) {
    const { data, setData, patch, processing, errors, recentlySuccessful } =
        useForm({
            name: user.name || "",
            email: user.email || "",
        });

    const submit = (e) => {
        e.preventDefault();
        patch("/profile");
    };

    return (
        <section>
            <header>
                <h2>Informacije o profilu</h2>
                <p>Ažurirajte informacije o svom profilu i email adresu.</p>
            </header>

            <form onSubmit={submit} className="mt-4">
                <div>
                    <label>Ime</label>
                    <input
                        type="text"
                        value={data.name}
                        onChange={(e) => setData("name", e.target.value)}
                    />
                    {errors.name && <div>{errors.name}</div>}
                </div>

                <div>
                    <label>Email</label>
                    <input
                        type="email"
                        value={data.email}
                        onChange={(e) => setData("email", e.target.value)}
                    />
                    {errors.email && <div>{errors.email}</div>}
                </div>

                <button disabled={processing}>Sačuvaj</button>

                {recentlySuccessful && <span>Sačuvano</span>}
            </form>
        </section>
    );
}

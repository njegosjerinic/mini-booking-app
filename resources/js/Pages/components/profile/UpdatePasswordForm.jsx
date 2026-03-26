import React from "react";

import { useForm } from "@inertiajs/react";

export default function UpdatePasswordForm() {
    const {
        data,
        setData,
        put,
        processing,
        errors,
        reset,
        recentlySuccessful,
    } = useForm({
        current_password: "",
        password: "",
        password_confirmation: "",
    });

    const submit = (e) => {
        e.preventDefault();
        put("/profile/password", {
            onSuccess: () => reset(),
        });
    };

    return (
        <section>
            <header>
                <h2>Ažuriraj lozinku</h2>
                <p>Koristi sigurnu lozinku.</p>
            </header>

            <form onSubmit={submit} className="mt-4">
                <div>
                    <label>Current Password</label>
                    <input
                        type="password"
                        value={data.current_password}
                        onChange={(e) =>
                            setData("current_password", e.target.value)
                        }
                    />
                    {errors.current_password && (
                        <div>{errors.current_password}</div>
                    )}
                </div>

                <div>
                    <label>New Password</label>
                    <input
                        type="password"
                        value={data.password}
                        onChange={(e) => setData("password", e.target.value)}
                    />
                    {errors.password && <div>{errors.password}</div>}
                </div>

                <div>
                    <label>Confirm Password</label>
                    <input
                        type="password"
                        value={data.password_confirmation}
                        onChange={(e) =>
                            setData("password_confirmation", e.target.value)
                        }
                    />
                    {errors.password_confirmation && (
                        <div>{errors.password_confirmation}</div>
                    )}
                </div>

                <button disabled={processing}>Sačuvaj</button>

                {recentlySuccessful && <span>Sačuvano</span>}
            </form>
        </section>
    );
}

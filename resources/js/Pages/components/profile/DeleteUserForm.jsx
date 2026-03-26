import React from "react";

import { useForm } from "@inertiajs/react";
import { useState } from "react";

export default function DeleteUserForm() {
    const [show, setShow] = useState(false);

    const {
        data,
        setData,
        delete: destroy,
        processing,
        errors,
    } = useForm({
        password: "",
    });

    const submit = (e) => {
        e.preventDefault();
        console.log("submit radi");

        destroy("/profile", {
            data: data,
        });
    };

    return (
        <section>
            <button onClick={() => setShow(true)}>Obriši račun</button>

            {show && (
                <form onSubmit={submit}>
                    <input
                        type="password"
                        value={data.password}
                        onChange={(e) => setData("password", e.target.value)}
                    />

                    {errors.password && <div>{errors.password}</div>}

                    <button type="button" onClick={() => setShow(false)}>
                        Otkaži
                    </button>

                    <button type="submit" disabled={processing}>
                        Obriši
                    </button>
                </form>
            )}
        </section>
    );
}

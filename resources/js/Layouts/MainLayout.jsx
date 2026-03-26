import React from "react";
import Navbar from "@/Pages/components/layout/Navbar";
import { usePage } from "@inertiajs/react";
import { useEffect } from "react";
import toastr from "toastr";
import "toastr/build/toastr.min.css";

export default function MainLayout({ children }) {
    const { flash } = usePage().props;

    useEffect(() => {
        if (flash?.success) {
            toastr.success(flash.success);
        }

        if (flash?.error) {
            toastr.error(flash.error);
        }
    }, [flash]);

    return (
        <>
            <>
                <Navbar />
                <main className=" py-4">{children}</main>
            </>
        </>
    );
}

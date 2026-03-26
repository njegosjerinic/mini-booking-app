import React from "react";
import "./bootstrap";

import { createInertiaApp } from "@inertiajs/react";
import { createRoot } from "react-dom/client";
import { resolvePageComponent } from "laravel-vite-plugin/inertia-helpers";

import MainLayout from "@/Layouts/MainLayout";

createInertiaApp({
    resolve: (name) =>
        resolvePageComponent(
            `./Pages/${name}.jsx`,
            import.meta.glob("./Pages/**/*.jsx"),
        ).then((module) => {
            const page = module.default;

            // ako stranica nema layout → dodaj MainLayout
            page.layout =
                page.layout || ((page) => <MainLayout>{page}</MainLayout>);

            return module;
        }),

    setup({ el, App, props }) {
        createRoot(el).render(<App {...props} />);
    },
});

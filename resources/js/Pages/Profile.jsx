import React from "react";

import UpdateProfileForm from "@/Pages/components/profile/UpdateProfileForm";
import UpdatePasswordForm from "@/Pages/components/profile/UpdatePasswordForm";
import DeleteUserForm from "@/Pages/components/profile/DeleteUserForm";

export default function Profile({ user }) {
    return (
        <div className="container py-4">
            <div className="max-w-7xl mx-auto space-y-6">
                <div className="p-4">
                    <UpdateProfileForm user={user} />
                </div>

                <div className="p-4">
                    <UpdatePasswordForm />
                </div>

                <div className="p-4">
                    <DeleteUserForm />
                </div>
            </div>
        </div>
    );
}

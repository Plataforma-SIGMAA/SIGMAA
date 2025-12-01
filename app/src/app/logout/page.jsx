"use client";

import { useEffect } from "react";
import { useApp } from "@/context/AppProvider";
import { redirect } from "next/navigation";

export default function LogoutPage() {
  const { logout } = useApp();
  useEffect(() => {
    logout();
    redirect("/login");
  }, [logout]);
  return null;
}

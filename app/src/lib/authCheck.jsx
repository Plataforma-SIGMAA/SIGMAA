"use client";

import { useEffect, useState } from "react";
import { useRouter } from "next/navigation";

export function authCheck({ requireAuth = false }) {
  const router = useRouter();
  const [checked, setChecked] = useState(false);
  const [allowed, setAllowed] = useState(false);

  useEffect(() => {
    const token = localStorage.getItem("authToken");

    if (requireAuth && !token) {
      router.replace("/login");
      return;
    }

    if (!requireAuth && token) {
      router.replace("/home");
      return;
    }

    setAllowed(true);
    setChecked(true);
  }, [requireAuth, router]);

  return { checked, allowed };
}

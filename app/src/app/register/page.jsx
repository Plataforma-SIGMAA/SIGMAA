"use client";

import { useState } from "react";
import api from "@/lib/api";

export default function RegisterPage() {
  const [name, setName] = useState("");
  const [email, setEmail] = useState("");
  const [password, setPassword] = useState("");
  const [c_password, setCPassword] = useState("");

  async function handleLogin(e) {
    e.preventDefault();
    console.log(name, email, password, c_password);
    try {
      await api.post("/auth/register", { name, email, password, c_password });
      window.location.href = "/login";
    } catch (err) {
      alert("Login inválido");
    }
  }

  return (
    <div className="flex h-screen items-center justify-center">
      <form
        onSubmit={handleLogin}
        className="w-96 p-6 rounded-2xl shadow bg-white space-y-4"
      >
        <h1 className="text-xl font-bold">Login</h1>
        <input
          type="text"
          placeholder="Nome"
          value={name}
          onChange={(e) => setName(e.target.value)}
        />
        <input
          type="email"
          placeholder="E-mail"
          value={email}
          onChange={(e) => setEmail(e.target.value)}
        />
        <input
          type="password"
          placeholder="Senha"
          value={password}
          onChange={(e) => setPassword(e.target.value)}
        />
        <input
          type="password"
          placeholder="Repita a Senha"
          value={c_password}
          onChange={(e) => setCPassword(e.target.value)}
        />
        <button type="submit" className="w-full">
          Entrar
        </button>
      </form>
    </div>
  );
}
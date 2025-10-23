"use client";

import { useState } from "react";
import api from "@/lib/api";
import "./login.css";

export default function LoginPage() {
  const [email, setEmail] = useState("");
  const [password, setPassword] = useState("");

  async function handleLogin(e) {
    e.preventDefault();
    try {
      await api.post("/auth/login", { email, password });
      window.location.href = "/dashboard";
    } catch (err) {
      alert("Login inválido");
    }
  }

  return (
    <div className="login-background">
      <div className="login-blob"></div>
      <div className="login-container">
        <h1 className="login-title">SIGMAA</h1>
        <p className="login-subtitle">Sistema Integrado de Gerenciamento de Materiais e Atividades Acadêmicas</p>

        <form onSubmit={handleLogin} className="login-form">
          <div className="login-email">
            <label htmlFor="email" className="login-label">Email</label>
            <input
              id="email"
              type="email"
              placeholder="Digite seu email"
              value={email}
              onChange={(e) => setEmail(e.target.value)}
              className="login-input"
            />
          </div>

          <div className="login-password">
            <label htmlFor="password" className="login-label">Senha</label>
            <input
              id="password"
              type="password"
              placeholder="Digite sua senha"
              value={password}
              onChange={(e) => setPassword(e.target.value)}
              className="login-input"
            />
            <p className="login-forgot-password">
              Esqueceu sua senha? Sem problemas! 
              <a href="#" className="forgot-password-link"> Clique aqui para iniciar a recuperação de senha</a>
            </p>
          </div>

          <button type="submit" className="login-button">
            Entrar
          </button>
        </form>
      </div>
    </div>
  );
}
"use client";

import { useState } from "react";
import { useApp } from "@/context/AppProvider";
import "./login.css";
import Loader from "@/components/Loader/Loader";

export default function LoginPage() {
  const { login } = useApp();

  const [email, setEmail] = useState("");
  const [password, setPassword] = useState("");
  const [loading, setLoading] = useState(false);

  async function handleLogin(e) {
    e.preventDefault();
    setLoading(true);
    try {
      await login(email, password);
    } catch (error) {
      console.error(error);
    } finally {
      setLoading(false);
    }
  }

  return (
    <div className="login-background">
      <div className="login-blob"></div>

      <div className="login-container">
        <h1 className="login-title">SIGMAA</h1>

        <p className="login-subtitle">
          Sistema Integrado de Gestão de Materiais e Atividades Acadêmicas
        </p>

        <form onSubmit={handleLogin} className="login-form">
          <div className="login-email">
            <label htmlFor="email" className="login-label">
              Email
            </label>
            <input
              id="email"
              type="email"
              placeholder="Digite seu email"
              value={email}
              onChange={(e) => setEmail(e.target.value)}
              className="login-input"
              required
            />
          </div>

          <div className="login-password">
            <label htmlFor="password" className="login-label">
              Senha
            </label>
            <input
              id="password"
              type="password"
              placeholder="Digite sua senha"
              value={password}
              onChange={(e) => setPassword(e.target.value)}
              className="login-input"
              required
            />

            <p className="login-forgot-password">
              Esqueceu sua senha? Sem problemas!
              <a href="#" className="forgot-password-link">
                {" "}
                Clique aqui
              </a>
            </p>
          </div>

          <button type="submit" className="login-button" disabled={loading}>
            Entrar
          </button>

          {loading && <Loader />}
        </form>
      </div>
    </div>
  );
}

"use client";

import { useApp } from "@/context/AppProvider";
import Academico from "./modules/academico";
import Admin from "./modules/admin";
import Header from "@/components/Header/Header";
import "./home.css";

export default function Home() {
  const { user, isLoading } = useApp();

  if (isLoading || !user) {
    return <main>Carregando...</main>;
  }

  return (
    <>
      <Header name={user.nome} />
      <main>
        {user.tipo == "Aluno" || user.tipo == "Professor" ? (
          <Academico role={user.tipo} />
        ) : null}
        {user.tipo == "Administrador" && <Admin />}
      </main>
    </>
  );
}

"use client";

import Header from "@/components/Header/Header";
import api from "@/lib/api";
import { useApp } from "@/context/AppProvider";
import { useParams } from "next/navigation";
import { useEffect, useState } from "react";
import Swal from "sweetalert2";
import Link from "next/link";
import styles from "./participantes.module.css";
import { Toast } from "@/components/Toast/Toast";
import { Router } from "next/router";

export default function Participantes() {
  const { user, authToken } = useApp();
  const { id } = useParams();

  const [disciplina, setDisciplina] = useState(null);

  const fetchDiscipline = async (id) => {
    if (!authToken) return;

    try {
      const response = await api.get(`/auth/disciplina/${id}/${user.id}`, {
        headers: {
          Authorization: `Bearer ${authToken}`,
        },
      });

      setDisciplina(response.data);
    } catch (error) {
      console.error("Erro ao buscar disciplina:", error);
    }
  };

  useEffect(() => {
    if (!authToken || !id) return;
    fetchDiscipline(id);
  }, [authToken, id]);

  useEffect(() => {
    console.log(disciplina);
  }, [disciplina]);

  useEffect(() => {
    if (!user || user.tipo !== "Estudante") return;

    const temPermissao = user.disciplina_ids?.includes(id);

    if (!temPermissao) {
      Toast.error("Você não tem permissão para acessar esta disciplina.")
        .then(() => {
          Router.push("/home");
        });
    }
  }, [user, id]);

  if (!disciplina)
    return (
      <>
        <Header name={user?.nome} />
        <main style={{ padding: "2rem" }}>Carregando...</main>
      </>
    );

  const {
    disciplina: info,
    plano: plano,
    avaliacoes,
    estudantes,
    notas,
    tarefas,
  } = disciplina;

  return (
    <>
      <Header name={user?.name} />
      <main className={styles.corpo}>
        <div className={styles.conteudo}>
          <h1 className={styles.title}>{info?.nome}</h1>

          {/* Docente */}
          <h2 className={styles.subtitle}>
            <span className={`material-symbols-outlined ${styles.docente}`}>
              school
            </span>
            Docente
          </h2>
          <section className={styles.container}>
            <div className={styles.grid}>
              {estudantes
                .filter((estud) => estud.tipo === "Professor")
                .map((estudante, idx) => (
                  <div key={idx} className={styles.card}>
                    <img src="/img/user.png" alt={estudante?.nome} />
                    <div>
                      <p className={styles.nome}>{estudante?.nome}</p>
                      <p className={styles.email}>{estudante?.email}</p>
                    </div>
                  </div>
                ))}
            </div>
          </section>

          {/* Discentes */}
          <h2 className={styles.subtitle}>
            <span className={`material-symbols-outlined ${styles.aluno}`}>
              person
            </span>
            Discentes
          </h2>
          <section className={styles.container}>
            <div className={styles.grid}>
              {estudantes
                .filter((estud) => estud.tipo === "Aluno")
                .map((estudante, idx) => (
                  <div key={idx} className={styles.card}>
                    <img src="/img/user.png" alt={estudante?.nome} />
                    <div>
                      <p className={styles.nome}>{estudante?.nome}</p>
                      <p className={styles.email}>{estudante?.email}</p>
                    </div>
                  </div>
                ))}
            </div>
          </section>
        </div>
        <a className={styles.voltar} href={`/disciplina/${id}`}>
          Voltar
        </a>
      </main>
    </>
  );
}

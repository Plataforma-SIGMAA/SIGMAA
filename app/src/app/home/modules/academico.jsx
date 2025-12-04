"use client";

import { useApp } from "@/context/AppProvider";
import styles from "./academico.module.css";
import { useEffect } from "react";

export default function Academico({ role }) {
  const { user, refreshProfile } = useApp();

  useEffect(() => {
    refreshProfile();

    const interval = setInterval(() => {
      refreshProfile();
    }, 20 * 60 * 1000);

    return () => clearInterval(interval);
  }, []);

  if (!user || !user.disciplinas) {
    return <div className={styles.container}>Carregando disciplinas...</div>;
  }

  if (user.disciplinas.length === 0) {
    return (
      <div className={styles.container}>
        Nenhuma disciplina encontrada.
      </div>
    );
  }

  const getCourseSigla = (courseName) => {
    if (courseName == "Técnico em Informática para Internet") return "TINF";
    else if (courseName == "Técnico em Agropecuária") return "TAGRO";
    else if (courseName == "Técnico em Administração") return "TADM";
    else if (courseName == "Técnico em Enologia e Viticultura") return "TENO";
    else if (courseName == "Técnico em Meio Ambiente") return "TMEI";
    else return "DISC";
  };

  const formatarData = (data) => {
    if (!data) return "";
    const date = new Date(data);
    return date.toLocaleDateString("pt-BR", { day: "2-digit", month: "2-digit" });
  };

  const disciplines = user.disciplinas || [];
  const nextActivities = user.avaliacoes_proximas || [];  

  const usefulLinks = [
    { href: "https://ifrs.edu.br/bento/registros-academicos/", label: "CRA - Registros Acadêmicos", icon: "description" },
    { href: "https://ifrs.edu.br/bento/biblioteca/", label: "Biblioteca", icon: "library_books" },
    { href: "https://moodle.bento.ifrs.edu.br", label: "Moodle", icon: "school" },
    { href: "https://ifrs.edu.br/bento/cae/", label: "CAE - Assuntos Estudantis", icon: "group" },
    { href: "https://ifrs.edu.br/bento/cae/refeitorio/", label: "Refeitório", icon: "restaurant" },
    { href: "https://ifrs.edu.br/bento/calendario-academico-4/", label: "Calendário Acadêmico", icon: "calendar_month" },
    { href: "https://mural.ifrs.edu.br", label: "Bolsas e Estágios", icon: "work" },
    { href: "https://ifrs.edu.br/bento/entidades-estudantis/", label: "Entidades Estudantis", icon: "diversity_3" },
    { href: "https://ifrs.edu.br/bento/registros-academicos/formaturas/", label: "Formaturas", icon: "card_giftcard" },
    { href: "https://ifrs.edu.br/bento/cursos/", label: "Cursos", icon: "computer" },
    { href: "https://ifrs.edu.br/bento/estagios/", label: "Estágios", icon: "business_center" },
    { href: "https://ifrs.edu.br/bento/perguntas-frequentes/", label: "Perguntas Frequentes", icon: "help" },
  ];

  return (
    <div className={styles.container}>
      <section className={styles.disciplinesSection}>
        <h2 className={styles.sectionTitle}>
          Disciplinas {role == "Aluno" ? "Cursadas" : "Ministradas"}
        </h2>
        <div className={styles.disciplinesGridScrollable}>
          <div className={styles.disciplinesGrid}>
            {disciplines.map((discipline) => (
              <a href={`disciplina/${discipline.id}`} key={discipline.id} className={styles.disciplineCard}>
                <div className={styles.disciplineHeader}></div>
                <div className={styles.disciplineContent}>
                  <div className={styles.disciplineContentRow}>
                    <span>{getCourseSigla(discipline.curso?.nome)} - {discipline.nome}</span>
                    <span className="material-symbols-outlined" style={{ fontSize: '20px', marginLeft: '10px' }}>
                      arrow_forward
                    </span>
                  </div>
                </div>
              </a>
            ))}
          </div>
        </div>
      </section>

      <aside className={styles.sidebar}>
        <div className={styles.linksContainer}>
          <h2 className={styles.linksTitle}>Espaço Estudantil</h2>
          <div className={styles.linksScrollable}>
            {usefulLinks.map((link, index) => (
              <a href={link.href} key={index} target="_blank" rel="noopener noreferrer" className={styles.linksCard}>
                <span className={`material-symbols-outlined ${styles.linksIcon}`}>{link.icon}</span>
                <span className={styles.linksLabel}>{link.label}</span>
                <span className={`material-symbols-outlined ${styles.linksArrow}`}>arrow_outward</span>
              </a>
            ))}
          </div>
        </div>

        <div className={styles.activitiesContainer}>
          <h2 className={styles.activitiesTitle}>Atividades Próximas</h2>

          <div className={styles.activitiesScrollable}>
            {nextActivities.length > 0 ? (
              nextActivities.map((activity) => (
                <div key={activity.id} className={styles.activityItem}>
                  <span className={styles.activityDate}>{formatarData(activity.data)}</span>
                  <span className={styles.activityDetails}>
                    {getCourseSigla(activity.disciplina?.nome)} - {activity.disciplina?.nome}
                  </span>
                  <span className={styles.activityType}>{activity.descricao}</span>
                </div>
              ))
            ) : (
              <div className={styles.activityItem} style={{ justifyContent: "center", color: "#999" }}>
                Nenhuma avaliação próxima
              </div>
            )}
          </div>
        </div>
      </aside>
    </div>
  );
}

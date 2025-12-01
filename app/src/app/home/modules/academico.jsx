import styles from "./academico.module.css";

export default function Academico(role) {
  const disciplines = Array(10).fill(0);
  const craItems = Array(5).fill(0);
  const nextActivities = Array(10).fill(0);

  return (
    <div className={styles.container}>
      <section className={styles.disciplinesSection}>
        <h2 className={styles.sectionTitle}>
          Disciplinas {role.role == "aluno" ? "Cursadas" : "Ministradas"}
        </h2>
        <div className={styles.disciplinesGridScrollable}>
          <div className={styles.disciplinesGrid}>
            {disciplines.map((_, index) => (
              <div key={index} className={styles.disciplineCard}>
                <div className={styles.disciplineHeader}></div>
                <div className={styles.disciplineContent}>
                  TIINF - Disciplina 2025/3
                </div>
              </div>
            ))}
          </div>
        </div>
      </section>

      <aside className={styles.sidebar}>
        <div className={styles.linksScrollable}>
          {craItems.map((_, index) => (
            <div key={index} className={styles.linksCard}>
              <div className={styles.linksIcon}></div>
              <span>CRA - Coordenadoria de Ass...</span>
            </div>
          ))}
        </div>

        <div className={styles.activitiesContainer}>
          <h2 className={styles.activitiesTitle}>Atividades Próximas</h2>

          <div className={styles.activitiesScrollable}>
            {nextActivities.map((_, index) => (
              <div key={index} className={styles.activityItem}>
                <span className={styles.activityDate}>11/09</span>
                <span className={styles.activityDetails}>
                  TIINF - Disciplina
                </span>
                <span className={styles.activityType}>Prova I</span>
              </div>
            ))}
          </div>
        </div>
      </aside>
    </div>
  );
}

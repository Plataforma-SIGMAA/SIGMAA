import styles from "./participantes.module.css";

export default function Participantes() {
  return (
    <>
      <main className={styles.corpo}>
       <div className={styles.menu}>
        <ul>
          <li><span className={`material-symbols-outlined ${styles.icon}`}>menu</span></li>
          <li className={styles.perfil}>
            Perfil 
            <span className={`material-symbols-outlined ${styles.conta}`}>account_circle</span>
            <span className={`material-symbols-outlined ${styles.abaixar}`}>expand_circle_down</span>
          </li>
        </ul>
      </div>

        <div className={styles.conteudo}>
          <h1 className={styles.title}>Desenvolvimento de Sistemas - Participantes</h1>

          {/* Docente */}
      <h2 className={styles.subtitle}><span className={`material-symbols-outlined ${styles.docente}`}>school</span>Docente</h2>
          <section className={styles.container}>
            <div className={styles.card}>
              <img src="/img/ronaldo.png" alt="Ronaldo" />
              <div>
                <p className={styles.nome}>Ronaldo</p>
                <p className={styles.email}>ronaldo@gmail.com</p>
              </div>
            </div>
          </section>

          {/* Discentes */}
          <h2 className={styles.subtitle}>
    <span className={`material-symbols-outlined ${styles.aluno}`}>person</span>
    Discentes
  </h2>
<section className={styles.container}>
  <div className={styles.grid}>
    <div className={styles.card}>
      <img src="/img/ronaldo.png" alt="Ronaldo" />
      <div>
        <p className={styles.nome}>Ronaldo</p>
        <p className={styles.email}>ronaldo@gmail.com</p>
      </div>
    </div>

    <div className={styles.card}>
      <img src="/img/ronaldo.png" alt="Ronaldo" />
      <div>
        <p className={styles.nome}>Ronaldo</p>
        <p className={styles.email}>ronaldo@gmail.com</p>
      </div>
    </div>

    <div className={styles.card}>
      <img src="/img/ronaldo.png" alt="Ronaldo" />
      <div>
        <p className={styles.nome}>Ronaldo</p>
        <p className={styles.email}>ronaldo@gmail.com</p>
      </div>
    </div>

    <div className={styles.card}>
      <img src="/img/ronaldo.png" alt="Ronaldo" />
      <div>
        <p className={styles.nome}>Ronaldo</p>
        <p className={styles.email}>ronaldo@gmail.com</p>
      </div>
    </div>

    <div className={styles.card}>
      <img src="/img/ronaldo.png" alt="Ronaldo" />
      <div>
        <p className={styles.nome}>Ronaldo</p>
        <p className={styles.email}>ronaldo@gmail.com</p>
      </div>
    </div>

    <div className={styles.card}>
      <img src="/img/ronaldo.png" alt="Ronaldo" />
      <div>
        <p className={styles.nome}>Ronaldo</p>
        <p className={styles.email}>ronaldo@gmail.com</p>
      </div>
    </div>

    <div className={styles.card}>
      <img src="/img/ronaldo.png" alt="Ronaldo" />
      <div>
        <p className={styles.nome}>Ronaldo</p>
        <p className={styles.email}>ronaldo@gmail.com</p>
      </div>
    </div>

    <div className={styles.card}>
      <img src="/img/ronaldo.png" alt="Ronaldo" />
      <div>
        <p className={styles.nome}>Ronaldo</p>
        <p className={styles.email}>ronaldo@gmail.com</p>
      </div>
    </div>

    <div className={styles.card}>
      <img src="/img/ronaldo.png" alt="Ronaldo" />
      <div>
        <p className={styles.nome}>Ronaldo</p>
        <p className={styles.email}>ronaldo@gmail.com</p>
      </div>
    </div>

    <div className={styles.card}>
      <img src="/img/ronaldo.png" alt="Ronaldo" />
      <div>
        <p className={styles.nome}>Ronaldo</p>
        <p className={styles.email}>ronaldo@gmail.com</p>
      </div>
    </div>

    <div className={styles.card}>
      <img src="/img/ronaldo.png" alt="Ronaldo" />
      <div>
        <p className={styles.nome}>Ronaldo</p>
        <p className={styles.email}>ronaldo@gmail.com</p>
      </div>
    </div>


    <div className={styles.card}>
      <img src="/img/ronaldo.png" alt="Ronaldo" />
      <div>
        <p className={styles.nome}>Ronaldo</p>
        <p className={styles.email}>ronaldo@gmail.com</p>
      </div>
    </div>
  </div>
</section>
  
        </div>
          <a className={styles.voltar} href="./materia">Voltar</a>
      </main>

      <footer className={styles.rodape}>
        Desenvolvido por...
      </footer>
    </>
  );
}
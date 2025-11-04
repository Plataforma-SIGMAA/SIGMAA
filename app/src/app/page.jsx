import styles from "./page.materia.module.css";

export default function Home() {
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

      <div className={styles.conteudoesq}>
        <h1 className={styles.titlemateria}>Desenvolvimento de Sistemas</h1>
        <div className={styles.diretorios}>
          <a href="participantes.jsx"><button className={styles.botaodir}>Participantes</button></a>
          <button className={styles.botaodir}>Notas</button>
          <button className={styles.botaodir}>Moodle</button>
        </div>

        <div className={styles.blocofreq}>
          <h2 className={styles.freq}>Frequência</h2>
          <div className={styles.caixafreq}>
            <div className={styles.valorfreq}>85%</div>
          </div>
          <h2 className={styles.freq}>Avaliações</h2>
        </div>
      <div className={styles.avaliacoescontainer}>
        <table className={styles.avaliacoes}>
          <thead>
            <tr>
              <th>Data</th>
              <th>Disciplina</th>
              <th>Avaliação</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>11/09</td>
              <td>TIINF - Disciplina</td>
              <td>Prova I</td>
            </tr>
            <tr>
              <td>11/09</td>
              <td>TIINF - Disciplina</td>
              <td>Prova I</td>
            </tr>
            <tr>
              <td>11/09</td>
              <td>TIINF - Disciplina</td>
              <td>Prova I</td>
            </tr>
            <tr>
              <td>11/09</td>
              <td>TIINF - Disciplina</td>
              <td>Prova I</td>
            </tr>
             <tr>
              <td>11/09</td>
              <td>TIINF - Disciplina</td>
              <td>Prova I</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
      <div className={styles.conteudodir}>
        <h2 className={styles.titulocont}>Conteúdos das aulas</h2>
        <div className={styles.listacont}>
          <div className={styles.aula}>
            <strong>Apresentação Sprint 1</strong>
            <p>23/05 - 30/05</p>
          </div>
          <div className={styles.aula}>
            <strong>Apresentação Sprint 2</strong>
            <p>30/05 - 06/06</p>
          </div>
          <div className={styles.feriado}>
            <strong>Feriado</strong>
            <p>23/05 - 30/05</p>
          </div>
          <div className={styles.aula}>
            <strong>Apresentação Sprint 4</strong>
            <p>23/05 - 30/05</p>
          </div>
          <div className={styles.aula}>
            <strong>Apresentação Sprint 5</strong>
            <p>23/05 - 30/05</p>
          </div>
          <div className={styles.aula}>
            <strong>Apresentação Sprint 6</strong>
            <p>23/05 - 30/05</p>
          </div>
          
        </div>
      </div>

  
    </main>
  <footer className={styles.rodape}>
    Desenvolvido por...
  </footer>
    </>
  );
}
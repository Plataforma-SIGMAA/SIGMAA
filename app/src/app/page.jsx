import styles from "./page.materia.module.css";

export default function Home() {
  return (
    <main >
        <div className={styles.menu}>
            <ul>
                <li><span className={`material-symbols-outlined ${styles.tamanho}`}>menu</span></li>
                <li className={styles.perfil}>Perfil</li>
            </ul>
        </div>
      <div >
        <h1 >Desenvolvimento de Sistemas</h1>
        <ul>
            <li><button>Participantes</button></li>
            <li><button>Notas</button></li>
            <li><button>Moddle</button></li>
        </ul>
        <div>Frequência</div>
        <div>85%</div>
        <div>Avaliações</div>
        <table>
          
          <tbody>
            <tr>
              <td>11/09</td>
              <td>TINF - Disciplina</td>
              <td>Prova 1</td>
            </tr>
            <tr>
              <td>11/09</td>
              <td>TINF - Disciplina</td>
              <td>Prova 1</td>
            </tr>
            <tr>
            <td>11/09</td>
              <td>TINF - Disciplina</td>
              <td>Prova 1</td>
            </tr>
            <tr>
            <td>11/09</td>
              <td>TINF - Disciplina</td>
              <td>Prova 1</td>
            </tr>
          </tbody>
        </table>
      </div>
      <div >
        <h2 >Conteúdos das aulas</h2>
        <div>
            <div><strong>Apresentação Sprint 1</strong> <p>23/05 - 30/05</p></div>
            <div><strong>Apresentação Sprint 2</strong> <p>30/05 - 06/06</p></div>
            <div><strong>Feriado</strong> <p>06/06 - 13/06</p></div>
            <div><strong>Apresentação Sprint 4</strong> <p>13/06 - 20/06</p></div>
            <div><strong>Apresentação Sprint 5</strong> <p>20/06 - 27/06</p></div>
            <div><strong>Apresentação Sprint 6</strong> <p>27/06 - 04/07</p></div>
        </div>
      </div>
      <div>rodapé</div>
    </main>
  );
}
import styles from "./boletim.module.css";
import Link from "next/link";

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
     

    <div className={styles["tabela-container"]}>
    <h3>Confira seus boletins</h3>

    <table className={styles["tabela-sigaa"]}>
        <thead>
            <tr>
                <th className={styles.title}>Ano</th>
                <th className={styles.title}>Situação</th>
            </tr>
        </thead>

        <tbody>

    <tr className={styles.linha}>
        <td className={styles.anos}>2023 - 1º Ano</td>
        <td className={styles.aprovado}>APROVADO <span className={styles.icon2}>✔</span></td>

        <Link href="#" className={styles.fullLink}></Link>
    </tr>

    <tr className={styles.linha}>
        <td className={styles.anos}>2024 - 2º Ano</td>
        <td className={styles.aprovado}>APROVADO <span className={styles.icon2}>✔</span></td>

        <Link href="#" className={styles.fullLink}></Link>
    </tr>

    <tr className={styles.linha}>
        <td className={styles.anos}>2025 - 3º Ano</td>
        <td className={styles.matriculado}>MATRICULADO <span className={styles.icon2}>✔</span></td>

        <Link href="#" className={styles.fullLink}></Link>
    </tr>

</tbody>

    </table>

    <button className={styles["btn-cancelar"]}>Cancelar</button>
</div>



 </main>
      <footer className={styles.rodape}>
        Desenvolvido por...
      </footer>
    </>
  );
}
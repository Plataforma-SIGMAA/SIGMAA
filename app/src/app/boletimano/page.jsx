import styles from "./boletimano.module.css";
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

<table className={styles.boletim}>
    <thead>
        <tr>
            <th className={styles.title}>Componente Curricular</th>
            <th className={styles.title}>1º Trimestre</th>
            <th className={styles.title}>2º Trimestre</th>
            <th className={styles.title}>3º Trimestre</th>
            <th className={styles.title}>Situação</th>
        </tr>
    </thead>

    <tbody>
        <tr>
            <td className={styles.materia}>MATEMÁTICA III</td>
            <td>9,3</td>
            <td>9,5</td>
            <td>9,4</td>
            <td className={styles.aprovado}>APROVADO</td>
        </tr>

        <tr>
            <td className={styles.materia}>QUÍMICA III</td>
            <td>7,7</td>
            <td>8,0</td>
            <td>9,1</td>
            <td className={styles.aprovado}>APROVADO</td>
        </tr>

        <tr>
            <td className={styles.materia}>GEOGRAFIA III</td>
            <td>8,8</td>
            <td>8,9</td>
            <td>9,0</td>
            <td className={styles.aprovado}>APROVADO</td>
        </tr>

        <tr>
            <td className={styles.materia}>HISTÓRIA III</td>
            <td>8,5</td>
            <td>9,3</td>
            <td>7,5</td>
            <td className={styles.aprovado}>APROVADO</td>
        </tr>

        <tr>
            <td className={styles.materia}>PROGRAMAÇÃO WEB III</td>
            <td>7,5</td>
            <td>7,5</td>
            <td>8,5</td>
            <td className={styles.reprovado}>RECUPERAÇÃO</td>
        </tr>
    </tbody>
</table>
<a href="/boletim"><button className={styles.voltar}>Voltar</button></a>
</main>
      <footer className={styles.rodape}>
        Desenvolvido por...
      </footer>
    </>
  );
}

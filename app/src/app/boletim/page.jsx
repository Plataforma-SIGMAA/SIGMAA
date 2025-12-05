"use client";

import Header from "@/components/Header/Header";
import styles from "./boletim.module.css";
import Link from "next/link";
import { useApp } from "@/context/AppProvider";

export default function Home() {
  const { user } = useApp();

  return (
    <>
    <Header name={user.nome} />
     

    <main className={styles.container}>
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
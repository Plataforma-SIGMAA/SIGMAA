import { useState, useRef, useEffect } from "react";
import styles from "./style.module.css";
import {useApp} from "@/context/AppProvider";

const Header = ({ name }) => {
  const { user } = useApp();
  const [open, setOpen] = useState(false);
  const closeTimer = useRef(null);

  useEffect(() => {
    return () => {
      if (closeTimer.current) clearTimeout(closeTimer.current);
    };
  }, []);

  const handleMouseEnter = () => {
    if (closeTimer.current) {
      clearTimeout(closeTimer.current);
      closeTimer.current = null;
    }
    setOpen(true);
  };

  const handleMouseLeave = () => {
    closeTimer.current = setTimeout(() => setOpen(false), 120);
  };

  const handleToggleClick = (e) => {
    e.preventDefault();
    if (closeTimer.current) {
      clearTimeout(closeTimer.current);
      closeTimer.current = null;
    }
    setOpen((s) => !s);
  };

  return (
    <header className={styles.menu} style={{ position: 'fixed', top: 0, left: 0, width: '100%', zIndex: 1000 }}>
      <ul>
        <li
          className={styles.perfil}
          onMouseEnter={handleMouseEnter}
          onMouseLeave={handleMouseLeave}
        >
          <button
            className={styles.perfilBtn}
            aria-haspopup="true"
            aria-expanded={open}
            onClick={handleToggleClick}
          >
            <span className={`material-symbols-outlined ${styles.conta}`}>
              account_circle
            </span>
            <span className={styles.nome}>{name || "Usuário"}</span>
            <span className={`material-symbols-outlined ${styles.abaixar}`}>
              expand_more
            </span>
          </button>

          <ul
            className={`${styles.dropdown} ${open ? styles.open : ""}`}
            role="menu"
            aria-hidden={!open}
          >
            <li role="none">
              <a role="menuitem" href="/home" tabIndex={open ? 0 : -1}>
                <span className="material-symbols-outlined">home</span>
                Início
              </a>
            </li>
            {user && (user.tipo === "Aluno") && (
              <li role="none">
                <a role="menuitem" href="/boletim" tabIndex={open ? 0 : -1}>
                  <span className="material-symbols-outlined">school</span>
                  Boletim
                </a>
              </li>
            )}
            <li role="none">
              <a role="menuitem" href="/configuracoes" tabIndex={open ? 0 : -1}>
                <span className="material-symbols-outlined">settings</span>
                Configurações
              </a>
            </li>

            <li role="none">
              <a role="menuitem" href="/logout" tabIndex={open ? 0 : -1}>
                <span className="material-symbols-outlined">logout</span>
                Sair
              </a>
            </li>
          </ul>
        </li>
      </ul>
    </header>
  );
};

export default Header;

"use client";

import { useEffect } from "react";
import "./admin.css";

export default function Admin() {
  useEffect(() => {
    const tabs = document.querySelectorAll(".tab_btn");
    const cards = document.querySelectorAll(".card");

    tabs.forEach((tab, i) => {
      tab.addEventListener("click", (e) => {
        tabs.forEach((tab) => tab.classList.remove("active"));
        tab.classList.add("active");

        const line = document.querySelector(".line");
        line.style.width = e.target.offsetWidth + "px";
        line.style.left = e.target.offsetLeft + "px";

        cards.forEach((content) => content.classList.remove("active"));
        cards[i].classList.add("active");
      });
    }, []);
  });

  return (
    <div className="admin">
      <h1>Painel Administrativo</h1>
      <div className="container">
        <div className="tab_box">
          <button className="tab_btn active">Aluno</button>
          <button className="tab_btn">Professor</button>
          <button className="tab_btn">Turma</button>
          <div className="line"></div>
        </div>
        <div className="context_box">
          <div className="card active">
            <h2>Aluno</h2>
            <div>Inserir aqui os botões e o que for necessário</div>
          </div>
          <div className="card">
            <h2>Professor</h2>
            <div>Inserir aqui os botões e o que for necessário</div>
          </div>
          <div className="card">
            <h2>Turma</h2>
            <div>
              Inserir aqui os botões e o que for necessário, inclusive as opções
              de disciplina na turma
            </div>
          </div>
        </div>
      </div>
    </div>
  );
}

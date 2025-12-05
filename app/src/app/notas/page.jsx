"use client";

import { useState } from "react";
import { useApp } from "@/context/AppProvider";
import Loader from "@/components/Loader/Loader";
import api from "@/lib/api";
import { useSearchParams } from "next/navigation";

export default function Notas() {

  const searchParams = useSearchParams();
  const id = searchParams.get("id");
  
  const buscarNotas = async () => {

  try {
    const resposta = await api.get(`/notas/${id}`);
    console.log("Notas recebidas:", resposta.data);
    return resposta.data;
  } catch (erro) {
    console.error("Erro ao buscar:", erro);
  }
};

buscarNotas()

  return (
    <div>

      <div>
        <div>1º Trimestre</div>
        <div>2º Trimestre</div>
        <div>3º Trimestre</div>
      </div>

      <table border={"1px"}>
        <thead>
          <tr>
            <th>Aluno</th>
            <th></th>
            <th>Nota Final</th>
          </tr>
        </thead>
      </table>
    </div>
  );
}

"use client";

import { useState, useEffect } from "react";
import { useSearchParams } from "next/navigation";
import api from "@/lib/api";

export default function Avaliacoes() {
  const [avaliacoes, setAvaliacoes] = useState([]);
  const [modalOpen, setModalOpen] = useState(false); 
  const [form, setForm] = useState({
    desc: "",
    data: "",
    horario: "",
  });

  const searchParams = useSearchParams();
  const id = searchParams.get("id");

  const buscarAvaliacoes = async () => {
    try {
      const resposta = await api.get(`/avaliacoes/${id}`);
      return resposta.data;
    } catch (error) {
      console.error(error);
      return [];
    }
  };

  useEffect(() => {
    if (!id) return;

    const carregar = async () => {
      const data = await buscarAvaliacoes();
      setAvaliacoes(data);
    };
    carregar();
  }, [id]);

  const salvarAvaliacao = async (e) => {
    e.preventDefault();

    try {
      await api.post("/avaliacoes/inserir", {
        desc: form.desc,
        data: form.data,
        horario: form.horario,
        disciplina_id: Number(id),
      });

      const data = await buscarAvaliacoes();
      setAvaliacoes(data);

      setModalOpen(false); 
      setForm({ desc: "", data: "", horario: "" });
    } catch (error) {
      console.error("Erro ao salvar", error);
    }
  };

  return (
    <div>

      <button onClick={() => setModalOpen(true)}>Nova Avaliação</button>

      <div>
        {avaliacoes.map((aval) => (
          <div key={aval.id}>
            <h2>{aval.desc}</h2>
            <p>Data: {aval.data}</p>
            <p>Horário: {aval.horario}</p>
          </div>
        ))}
      </div>

      {modalOpen && (
        <div>
          <div>

            <h2>Nova Avaliação</h2>

            <form onSubmit={salvarAvaliacao}>

              <input type="text" placeholder="Descrição" value={form.desc} onChange={(e) => setForm({ ...form, desc: e.target.value })} required/>

              <input type="date" value={form.data} onChange={(e) => setForm({ ...form, data: e.target.value })} required/>

              <input type="time" value={form.horario} onChange={(e) => setForm({ ...form, horario: e.target.value })} required/>

              <div>
                <button type="button" onClick={() => setModalOpen(false)}>Cancelar</button>

                <button type="submit">Salvar</button>
              </div>
            </form>

          </div>
        </div>
      )}
    </div>
  );
}

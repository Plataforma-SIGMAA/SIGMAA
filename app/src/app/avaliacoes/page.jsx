"use client";

import { useState, useEffect } from "react";
import { useSearchParams } from "next/navigation";
import api from "@/lib/api";
import { useApp } from "@/context/AppProvider";
import Header from "@/components/Header/Header";
import "./av.css";


export default function Avaliacoes() {
  const { user } = useApp();
  const [avaliacoes, setAvaliacoes] = useState([]);
  const [modalOpen, setModalOpen] = useState(false); 
  const [form, setForm] = useState({
    desc: "",
    data: "",
    horario: "",
    disciplina_id: 7,
  });
  const [editId, setEditId] = useState(null);

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
      if (editId) {
        await api.put(`/avaliacoes`, {
          id: editId,
          desc: form.desc,
          data: form.data,
          horario: form.horario,
          disciplina_id: form.disciplina_id,
        });
      } else {
        await api.post(`/avaliacoes/inserir`, {
          desc: form.desc,
          data: form.data,
          horario: form.horario,
          disciplina_id: form.disciplina_id,
        });
      }

      const data = await buscarAvaliacoes();
      setAvaliacoes(data);

      setModalOpen(false);
      setForm({ desc: "", data: "", horario: "", disciplina_id: 7 });
      setEditId(null);

    } catch (error) {
      console.error("Erro ao salvar", error);
    }

    //   await api.post(`/avaliacoes/inserir`, {
    //     desc: form.desc,
    //     data: form.data,
    //     horario: form.horario,
    //     disciplina_id: form.disciplina_id,
    //   });

    //   const data = await buscarAvaliacoes();
    //   setAvaliacoes(data);

    //   setModalOpen(false); 
    //   setForm({ desc: "", data: "", horario: "", disciplina_id: 7});
    // } catch (error) {
    //   console.error("Erro ao salvar", error);

  };

  const excluirAvaliacao = async (idAvaliacao) => {
  try {
    await api.delete(`/avaliacoes/${idAvaliacao}`);

    const data = await buscarAvaliacoes();
    setAvaliacoes(data);

  } catch (error) {
    console.error("Erro ao excluir", error);
  }
};

  return (
    <div className="avaliacoes-page">
      <Header name={user?.nome} />
      <main className="avaliacao-main">

          <button className="btn-add" onClick={() => setModalOpen(true)}>Nova Avaliação</button>

          <div className="cards-container">
            {avaliacoes.map((aval) => (
              <div key={aval.id} className="avaliacao-card">
                <div className="avaliacao-info">
                  <h2>{aval.desc}</h2>
                  <p>Data: {aval.data}</p>
                  <p>Horário: {aval.horario}</p>
                </div>

              <div className="card-actions">
                <button className="btn-delete" onClick={() => excluirAvaliacao(aval.id)}>Excluir</button>
                <button className="btn-edit" onClick={() => {
                  setEditId(aval.id);
                  setForm({
                    desc: aval.desc,
                    data: aval.data,
                    horario: aval.horario,
                    disciplina_id: aval.disciplina_id,
                  });
                  setModalOpen(true);
                }}
                >Editar</button>

                </div>
              </div>
            ))}
          </div>

          {modalOpen && (
            <div className="modal-overlay">
              <div className="modal-box">

                <h2>{editId ? "Editar Avaliação" : "Nova Avaliação"}</h2>

                <form onSubmit={salvarAvaliacao}>

                  <input type="text" placeholder="Descrição" value={form.desc} onChange={(e) => setForm({ ...form, desc: e.target.value })} required/>

                  <input type="date" placeholder="Data" value={form.data} onChange={(e) => setForm({ ...form, data: e.target.value })} required/>

                  <input type="text" placeholder="Horário" value={form.horario} onChange={(e) => setForm({ ...form, horario: e.target.value })} required/>

                  <input type="hidden" value={form.disciplina_id} onChange={(e) => setForm({ ...form, disciplina_id: e.target.value })} required/>

                  {editId && (
                      <input
                        type="hidden"
                        name="id"
                        value={editId}
                      />
                  )}

                  <div className="modal-actions">
                    <button type="button" className="btn-cancel" onClick={() => setModalOpen(false)}>Cancelar</button>

                    <button type="submit" className="btn-save">Salvar</button>
                  </div>
                </form>

              </div>
            </div>
          )}
      </main>
    </div>
  );
}

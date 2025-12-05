"use client";

import Header from "@/components/Header/Header";
import styles from "./configuracoes.module.css";
import { useApp } from "@/context/AppProvider";
import { useEffect, useState } from "react";
import { Toast } from "@/components/Toast/Toast";
import api from "@/lib/api";

const initialState = {
  telefone: "",
  email: "",
  bairro: "",
  rua: "",
  numero_casa: "",
  cep: "",
  sexo: "",
  etnia: "",
  pais: "",
  uf: "",
  nacionalidade: "",
  naturalidade: "",
  password: "",
  newPassword: "",
  confirmPassword: "",
};

const Config = () => {
  const { user, refreshProfile } = useApp();

  const [form, setForm] = useState(initialState);

  useEffect(() => {
    if (user) {
      setForm({
        telefone: user.telefone || "",
        email: user.email || "",
        bairro: user.bairro || "",
        rua: user.rua || "",
        numero_casa: user.numero_casa || "",
        cep: user.cep || "",
        sexo: user.sexo || "",
        etnia: user.etnia || "",
        pais: user.pais || "",
        uf: user.uf || "",
        nacionalidade: user.nacionalidade || "",
        naturalidade: user.naturalidade || "",
        password: "",
        newPassword: "",
        confirmPassword: "",
      });
    }
  }, [user]);

  const handleChange = (e) => {
    const { name, value } = e.target;
    setForm((prev) => ({ ...prev, [name]: value }));
  };

const handleSubmit = async () => {
  try {
    const payload = {
      telefone: form.telefone,
      email: form.email,
      sexo: form.sexo,
      etnia: form.etnia,
      pais: form.pais,
      uf: form.uf,
      cep: form.cep,
      bairro: form.bairro,
      rua: form.rua,
      numero_casa: form.numero_casa,
      nacionalidade: form.nacionalidade,
      naturalidade: form.naturalidade,

      password: form.password,
      newPassword: form.newPassword,
      confirmPassword: form.confirmPassword,
    };

    const response = await api.put(`/user/${user.id}`, payload);

    Toast.success("Dados atualizados com sucesso!");

    const atualizarUser = await refreshProfile();
  } catch (error) {
    if (error.response?.data?.message) {
      Toast.error(error.response.data.message);
    } else {
      Toast.error("Erro ao salvar alterações.");
    }
  }
};


  return (
    <div>
      <Header name={user?.nome} />

      <main className={styles.container}>
        <h1 className={styles.titulo}>Configurações</h1>

        <section className={styles.section}>
          <h2>Identificação</h2>

          <div className={styles.grid}>
            <Campo label="Matrícula" value={user?.matricula} readonly />
            <Campo label="CPF" value={user?.cpf} readonly />
            <Campo label="RG" value={user?.rg} readonly />
            <Campo label="Nível" value={user?.tipo} readonly />
            <Campo label="Curso" value={user?.curso} readonly />
          </div>
        </section>

        <section className={styles.section}>
          <h2>Dados Pessoais</h2>

          <div className={styles.grid}>
            <Campo label="Nome" value={user?.nome} readonly />
            <Campo label="Data de nascimento" value={user?.data_nasc} readonly />
            <Campo label="Pai" value={user?.pai} readonly />
            <Campo label="Mãe" value={user?.mae} readonly />

            <Sexo
              label="Sexo"
              name="sexo"
              value={form.sexo}
              onChange={handleChange}
            />

            <Etnia
              label="Etnia"
              name="etnia"
              value={form.etnia}
              onChange={handleChange}
            />
          </div>
        </section>

        <section className={styles.section}>
          <h2>Endereço</h2>

          <div className={styles.grid}>
            <Input label="CEP" name="cep" value={form.cep} onChange={handleChange} />
            <Input label="Rua" name="rua" value={form.rua} onChange={handleChange} />
            <Input label="Número" name="numero_casa" value={form.numero_casa} onChange={handleChange} />
            <Input label="Bairro" name="bairro" value={form.bairro} onChange={handleChange} />
            <Input label="UF" name="uf" value={form.uf} onChange={handleChange} />
            <Input label="País" name="pais" value={form.pais} onChange={handleChange} />
          </div>
        </section>

        <section className={styles.section}>
          <h2>Contato</h2>

          <div className={styles.grid}>
            <Input
              label="Telefone"
              name="telefone"
              value={form.telefone}
              onChange={handleChange}
            />

            <Input
              label="Email"
              type="email"
              name="email"
              value={form.email}
              onChange={handleChange}
              aviso="Por solução provisória, o email será verificado automaticamente."
            />
          </div>
        </section>

        <section className={styles.section}>
          <h2>Segurança</h2>

          <div className={styles.grid}>
            <Input
              label="Senha atual"
              type="password"
              name="password"
              value={form.password}
              onChange={handleChange}
            />

            <Input
              label="Nova senha"
              type="password"
              name="newPassword"
              value={form.newPassword}
              onChange={handleChange}
            />

            <Input
              label="Confirmar nova senha"
              type="password"
              name="confirmPassword"
              value={form.confirmPassword}
              onChange={handleChange}
            />
          </div>
        </section>

        <div className={styles.footer}>
            <button onClick={handleSubmit} className={styles.salvar}>
                Salvar alterações
            </button>
        </div>
      </main>
    </div>
  );
};

export default Config;

/* =================== COMPONENTES =================== */

const Campo = ({ label, value, readonly }) => (
  <div className={styles.field}>
    <label>{label}</label>
    <input value={value || ""} readOnly={readonly} />
  </div>
);

const Input = ({ label, aviso, ...props }) => (
  <div className={styles.field}>
    <label>{label}</label>
    <input {...props} />
    {aviso && <small className={styles.alerta}>{aviso}</small>}
  </div>
);

const Sexo = ({ label, ...props }) => (
  <div className={styles.field}>
    <label>{label}</label>
    <select {...props}>
      <option value="">Selecione</option>
      <option value="Macho">Macho</option>
      <option value="Fêmea">Fêmea</option>
      <option value="Intersexo">Intersexo</option>
    </select>
  </div>
);

const Etnia = ({ label, ...props }) => (
  <div className={styles.field}>
    <label>{label}</label>
    <select {...props}>
      <option value="">Selecione</option>
      <option value="Branca">Branca</option>
      <option value="Preta">Preta</option>
      <option value="Parda">Parda</option>
      <option value="Amarela">Amarela</option>
      <option value="Indígena">Indígena</option>
    </select>
  </div>
);

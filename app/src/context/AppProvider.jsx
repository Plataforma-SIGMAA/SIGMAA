"use client";

import api from "@/lib/api";
import { createContext, useContext, useEffect, useState } from "react";
import { useRouter, usePathname } from "next/navigation";
import { Alert } from "@/components/Alert/Alert";
import { Toast } from "@/components/Toast/Toast";

const AppContext = createContext(undefined);

export const AppProvider = ({ children }) => {
  const [isLoading, setIsLoading] = useState(true);
  const [authToken, setAuthToken] = useState(null);
  const [user, setUser] = useState(null);

  const router = useRouter();
  const pathname = usePathname();

  useEffect(() => {
    const token = localStorage.getItem("authToken");
    const storedUser = localStorage.getItem("user");

    if (token) {
      setAuthToken(token);

      console.log("token", authToken);

      if (storedUser) {
        console.log(storedUser);
        try {
          setUser(JSON.parse(storedUser));
        } catch {
          console.error("Erro ao fazer parse do usuário:", storedUser);
          setUser(null);
        }
      }
    } else {
      if (!pathname.includes("/login")) {
        router.replace("/login");
      }
    }

    setIsLoading(false);
  }, []);

  const formatErrorMessages = (errorData) => {
    if (typeof errorData === "string") return errorData;

    if (errorData?.errors) {
      return Object.values(errorData.errors)
        .flat()
        .map((error) => `• ${error}<br>`)
        .join("");
    }

    if (errorData?.message) return errorData.message;

    return "Ocorreu um erro desconhecido. Por favor, tente novamente.";
  };

  const login = async (email, password) => {
    setIsLoading(true);
    try {
      const response = await api.post("/auth/login", { email, password });
      if (response.status) {
        console.log(response.data);
        const token = response.data.access_token;

        const data = await api.post("/auth/profile", null, {
          headers: {
            Authorization: `Bearer ${token}`,
          },
        });

        const userData = data.data?.data ?? data.data;

        localStorage.setItem("authToken", token);
        localStorage.setItem("user", JSON.stringify(userData));
        document.cookie = `authToken=${token}; path=/; SameSite=Lax`;

        setAuthToken(token);
        setUser(userData);

        console.log("userData", userData, user);

        Toast.success("Login realizado com sucesso!");

        router.replace("/home");
      } else {
        Alert.error("", {
          html: formatErrorMessages(response.data.message),
          title: "Login inválido",
        });
      }
    } catch (error) {
      console.error(error);
      Alert.error("", {
        html: formatErrorMessages(error.response?.data),
        title: "Opa!",
      });
    } finally {
      setIsLoading(false);
    }
  };

  const register = async (login, email, password, password_confirmation) => {
    setIsLoading(true);
    try {
      const response = await api.post("/auth/register", {
        login,
        email,
        password,
        password_confirmation,
      });

      if (response.data.status) {
        Alert.success("Você já pode fazer login.", {
          title: "Cadastro realizado!",
        });
        router.push("/auth?tipo=login");
      } else {
        Alert.error("", {
          html: formatErrorMessages(response.data.message),
          title: "Erro no cadastro",
        });
      }
    } catch (error) {
      Alert.error("", {
        html: formatErrorMessages(error.response?.data),
        title: "Opa!",
      });
    } finally {
      setIsLoading(false);
    }
  };

  const logout = () => {
    localStorage.removeItem("authToken");
    localStorage.removeItem("user");
    document.cookie = "authToken=; path=/; max-age=0";

    setAuthToken(null);
    setUser(null);

    router.replace("/login");
  };

  return (
    <AppContext.Provider
      value={{
        login,
        register,
        logout,
        isLoading,
        authToken,
        user,
        setUser,
      }}
    >
      {children}
    </AppContext.Provider>
  );
};

export const useApp = () => {
  const context = useContext(AppContext);
  if (!context) {
    throw new Error("Contexto deve estar dentro de AppProvider");
  }
  return context;
};

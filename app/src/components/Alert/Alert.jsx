// alert.jsx
import Swal from "sweetalert2";

export const showAlert = (type, message, options = {}) => {
  const defaultOptions = {
    text: message,
    showCancelButton: false,
    ...options,
  };

  return Swal.fire({
    icon: type,
    theme: "dark",
    ...defaultOptions,
  });
};

// Alertas mais simples
export const Alert = {
  success: (message, options) =>
    showAlert("success", message, options),
  error: (message, options) =>
    showAlert("error", message, options),
  warning: (message, options) =>
    showAlert("warning", message, options),
  info: (message, options) =>
    showAlert("info", message, options),
  confirm: (message, options) =>
    showAlert("question", message, { showCancelButton: true, ...options }),
  fire: (options) => Swal.fire(options),
};

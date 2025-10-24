// /toast.jsx
import {
  toast,
  ToastContainer as ReactToastContainer,
} from "react-toastify";
import "react-toastify/dist/ReactToastify.css";

const showToast = (
  type,
  message,
  options = {}
) => {
  const finalMessage = options.text || message || options.message || "";
  const {
    title,
    cancelButtonText,
    confirmButtonText,
    showConfirmButton = type === "question" ? true : options.showConfirmButton,
    showCancelButton = type === "question" ? true : options.showCancelButton,
    onConfirm,
    onCancel,
    html,
    timer,
    timerProgressBar,
    ...toastOptions
  } = options;

  const content = (
    <div className="custom-toast">
      {title && <h4 className="toast-title">{title}</h4>}
      {html ? (
        <div dangerouslySetInnerHTML={{ __html: html }} />
      ) : (
        <p className="toast-message">{finalMessage}</p>
      )}
      {(showConfirmButton || showCancelButton) && (
        <div className="toast-buttons">
          {showCancelButton && (
            <button
              className="toast-button cancel"
              onClick={() => {
                onCancel?.();
                toast.dismiss();
              }}
            >
              {cancelButtonText || "Cancelar"}
            </button>
          )}
          {showConfirmButton && (
            <button
              className="toast-button confirm"
              onClick={() => {
                onConfirm?.();
                toast.dismiss();
              }}
            >
              {confirmButtonText || "Confirmar"}
            </button>
          )}
        </div>
      )}
    </div>
  );

  return toast(content, {
    type: type === "question" ? "default" : type,
    theme: "dark",
    position: "bottom-right",
    autoClose: 1500,
    hideProgressBar: !timerProgressBar,
    ...toastOptions,
  });
};

export const Toast = {
  success: (message, options) =>
    showToast("success", message, options),
  error: (message, options) =>
    showToast("error", message, options),
  warning: (message, options) =>
    showToast("warning", message, options),
  info: (message, options) =>
    showToast("info", message, options),
  confirm: (message, options) =>
    showToast("question", message, {
      showCancelButton: true,
      showConfirmButton: true,
      ...options,
    }),
  dismiss: toast.dismiss,
};

export const ToastContainer = () => (
  <div className="toast-provider">
    <ReactToastContainer
      position="top-right"
      newestOnTop
      closeOnClick={false}
      draggable
      pauseOnHover
      theme="colored"
      toastClassName="custom-toast-wrapper"
      progressClassName="toast-progress-bar"
    />
  </div>
);
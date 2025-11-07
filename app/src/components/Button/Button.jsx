import { ButtonDefault, ButtonSuccess } from "./styles";

export function Button({ type, text, onClick }) {
  return type === "default" ? (
    <ButtonDefault onClick={onClick}>{text}</ButtonDefault>
  ) : (
    <ButtonSuccess onClick={onClick}>{text}</ButtonSuccess>
  );
}
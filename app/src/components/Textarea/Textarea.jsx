import "./style.css";

const Textarea = ({ id, name, label }) => {
  return (
   <div className="basic-input-div">
      <label htmlFor={id} className="basic-label">{label}</label>
      <textarea id={id} name={name} className="basic-textarea"></textarea>
    </div>
  );
};

export default Textarea;

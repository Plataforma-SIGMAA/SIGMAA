import "./home.css";

export default function Home() {
  return (
    <>
        <header className='home-header'>
            
        </header>

        <main className='home-main'>
            <div className='home-disciplnes'>
                <div className='home-disciplines-options'>
                    <h2 className='home-disciplines-title'>Disciplinas</h2>
                    <form className='home-disciplines-form'>
                        <label className='home-disciplines-filter-label' htmlFor='discipline-filter'>Filtrar por:</label>
                        <select className='home-disciplines-filter' name='discipline-filter' id='discipline-filter'>
                            <option value='' className='home-disciplines-filter-option'></option>
                        </select>
                    </form>
                </div>

                <div className='home-disciplines-container'>
                    <a className='home-disciplines-card' href='#'>
                        <img className='home-disciplines-card-image' src='#' alt='' />
                        <div className='home-disciplines-card-info'>
                            <h3 className='home-disciplines-card-discipline'>TINF - Desenvolvimento de Sistemas</h3>
                        </div>
                    </a>
                </div>
            </div>

            <div className='home-links'>
                <h2 className='home-links-title'>Links</h2>
                <ol className='home-links-ol'>
                    <li className='home-links-li'>
                        <a className='home-links-link' href='#'>IFRS - Bento Gonçalves</a>
                    </li>
                </ol>
            </div>

            <div className='home-activities'>
                <h2 className='home-activities-title'>Atividades</h2>
                <ol className='home-activities-ol'>
                    <li className='home-activities-li'>
                        <p className='home-activities-date'>00/00/0000</p>
                        <p className='home-activities-discipline'>TINF - Desenvolvimento de Sistemas</p>
                        <p className='home-activities-name'>Atividade 1</p>
                    </li>
                </ol>
            </div>
        </main>

        <footer className='home-footer'>
            
        </footer>
    </>
  );
}
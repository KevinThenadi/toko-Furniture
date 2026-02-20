import React, { useState, useEffect, useRef } from 'react';
import { createRoot } from 'react-dom/client';

function RoomPlanner() {
    // --- STATE MANAGEMENT ---
    const [roomItems, setRoomItems] = useState([]); // Barang di canvas
    const [selectedId, setSelectedId] = useState(null); // Barang yang sedang diklik/aktif
    const [isDragging, setIsDragging] = useState(false); // Status drag internal
    const dragItem = useRef(null); // Ref untuk menyimpan item yang sedang digeser
    const canvasRef = useRef(null); // Ref untuk area canvas

    // --- DATA DUMMY (Nanti bisa diganti fetch API Laravel) ---
    // Gunakan gambar transparan (PNG) atau icon untuk hasil terbaik
    const furnitureList = [
        { id: 1, name: 'Sofa 2 Seater', price: 2500000, type: 'img', src: 'https://cdn-icons-png.flaticon.com/512/2663/2663670.png', w: 120, h: 60 },
        { id: 2, name: 'Meja Kopi', price: 850000, type: 'img', src: 'https://cdn-icons-png.flaticon.com/512/2663/2663663.png', w: 80, h: 80 },
        { id: 3, name: 'Karpet Besar', price: 400000, type: 'rect', color: '#bdc3c7', w: 150, h: 200 }, // Contoh item bentuk kotak
        { id: 4, name: 'Tanaman Hias', price: 150000, type: 'img', src: 'https://cdn-icons-png.flaticon.com/512/628/628324.png', w: 50, h: 50 },
        { id: 5, name: 'TV Cabinet', price: 3000000, type: 'rect', color: '#5D4037', w: 140, h: 40 },
    ];

    // --- EFFECT: Load & Save ke LocalStorage ---
    useEffect(() => {
        const saved = localStorage.getItem('roomDesign');
        if (saved) setRoomItems(JSON.parse(saved));
    }, []);

    useEffect(() => {
        localStorage.setItem('roomDesign', JSON.stringify(roomItems));
    }, [roomItems]);

    // --- LOGIC: ADD ITEM (Drop dari Sidebar) ---
    const handleDragStartSidebar = (e, item) => {
        e.dataTransfer.setData("itemData", JSON.stringify(item));
        setSelectedId(null);
    };

    const handleDropCanvas = (e) => {
        e.preventDefault();
        const data = e.dataTransfer.getData("itemData");
        if (!data) return; // Jika drag bukan dari sidebar, abaikan drop ini
        
        const item = JSON.parse(data);
        const rect = e.target.getBoundingClientRect();
        
        const newItem = {
            ...item,
            uid: Date.now(), // ID unik untuk setiap instance
            x: e.clientX - rect.left - (item.w / 2),
            y: e.clientY - rect.top - (item.h / 2),
            rotation: 0
        };

        setRoomItems([...roomItems, newItem]);
        setSelectedId(newItem.uid);
    };

    const handleDragOver = (e) => e.preventDefault();

    // --- LOGIC: MOVE ITEM (Geser di dalam Canvas) ---
    const handleMouseDown = (e, uid) => {
        e.stopPropagation(); // Biar tidak tembus ke canvas
        setSelectedId(uid);
        setIsDragging(true);
        dragItem.current = uid;
    };

    const handleMouseMove = (e) => {
        if (!isDragging || !dragItem.current) return;

        const canvasRect = canvasRef.current.getBoundingClientRect();
        const x = e.clientX - canvasRect.left;
        const y = e.clientY - canvasRect.top;

        setRoomItems(prev => prev.map(item => {
            if (item.uid === dragItem.current) {
                return { ...item, x: x - (item.w / 2), y: y - (item.h / 2) };
            }
            return item;
        }));
    };

    const handleMouseUp = () => {
        setIsDragging(false);
        dragItem.current = null;
    };

    // --- LOGIC: CONTROLS (Rotate & Delete) ---
    const handleRotate = () => {
        setRoomItems(prev => prev.map(item => 
            item.uid === selectedId ? { ...item, rotation: (item.rotation + 90) % 360 } : item
        ));
    };

    const handleDelete = () => {
        setRoomItems(prev => prev.filter(item => item.uid !== selectedId));
        setSelectedId(null);
    };

    // --- LOGIC: Total Harga ---
    const totalPrice = roomItems.reduce((acc, curr) => acc + curr.price, 0);

    return (
        <div className="container-fluid py-4" onMouseUp={handleMouseUp} onMouseMove={handleMouseMove}>
            <div className="row">
                {/* 1. SIDEBAR KATALOG */}
                <div className="col-md-3">
                    <div className="card shadow border-0">
                        <div className="card-header bg-dark text-white">
                            <h6 className="mb-0">Katalog Furnitur</h6>
                        </div>
                        <div className="card-body" style={{ maxHeight: '70vh', overflowY: 'auto' }}>
                            <div className="row g-2">
                                {furnitureList.map(item => (
                                    <div key={item.id} className="col-6">
                                        <div 
                                            className="border rounded p-2 text-center hover-shadow"
                                            draggable
                                            onDragStart={(e) => handleDragStartSidebar(e, item)}
                                            style={{ cursor: 'grab', background: '#fff' }}
                                        >
                                            {item.type === 'img' ? (
                                                <img src={item.src} alt={item.name} style={{ width: '40px', height: '40px', objectFit: 'contain' }} />
                                            ) : (
                                                <div style={{ width: '40px', height: '30px', background: item.color, margin: '0 auto' }}></div>
                                            )}
                                            <div className="small mt-2 fw-bold">{item.name}</div>
                                            <div className="text-muted" style={{ fontSize: '10px' }}>Rp {item.price.toLocaleString()}</div>
                                        </div>
                                    </div>
                                ))}
                            </div>
                        </div>
                        
                        {/* Ringkasan Harga */}
                        <div className="card-footer bg-light">
                            <small className="text-muted">Estimasi Biaya:</small>
                            <h5 className="fw-bold text-primary">Rp {totalPrice.toLocaleString()}</h5>
                            <button className="btn btn-success btn-sm w-100 mt-2">
                                <i className="bi bi-cart-plus"></i> Masukkan Keranjang
                            </button>
                        </div>
                    </div>

                    {/* Instruksi */}
                    <div className="alert alert-info mt-3 small">
                        <i className="bi bi-info-circle"></i> <strong>Tips:</strong> Klik barang di canvas untuk memutar atau menghapus.
                    </div>
                </div>

                {/* 2. AREA CANVAS */}
                <div className="col-md-9">
                    <div className="card shadow-sm border-0">
                        {/* Toolbar Kontrol */}
                        <div className="card-header bg-white d-flex justify-content-between align-items-center">
                            <span className="fw-bold"><i className="bi bi-grid-3x3"></i> Denah Ruangan</span>
                            
                            {selectedId && (
                                <div>
                                    <button onClick={handleRotate} className="btn btn-sm btn-outline-primary me-2">
                                        <i className="bi bi-arrow-clockwise"></i> Putar
                                    </button>
                                    <button onClick={handleDelete} className="btn btn-sm btn-outline-danger">
                                        <i className="bi bi-trash"></i> Hapus
                                    </button>
                                </div>
                            )}
                            
                            {!selectedId && roomItems.length > 0 && (
                                <button onClick={() => setRoomItems([])} className="btn btn-sm btn-link text-danger text-decoration-none">
                                    Reset Semua
                                </button>
                            )}
                        </div>

                        {/* Canvas Area */}
                        <div 
                            ref={canvasRef}
                            className="position-relative w-100"
                            onDrop={handleDropCanvas}
                            onDragOver={handleDragOver}
                            onClick={() => setSelectedId(null)} // Klik kosong untuk deselect
                            style={{ 
                                height: '600px', 
                                backgroundColor: '#f0f2f5', 
                                backgroundImage: 'linear-gradient(#e1e4e8 1px, transparent 1px), linear-gradient(90deg, #e1e4e8 1px, transparent 1px)',
                                backgroundSize: '40px 40px', // Grid lantai
                                overflow: 'hidden',
                                cursor: isDragging ? 'grabbing' : 'default'
                            }}
                        >
                            {roomItems.map((item) => (
                                <div
                                    key={item.uid}
                                    onMouseDown={(e) => handleMouseDown(e, item.uid)}
                                    style={{
                                        position: 'absolute',
                                        left: item.x,
                                        top: item.y,
                                        width: item.w,
                                        height: item.h,
                                        transform: `rotate(${item.rotation}deg)`,
                                        border: selectedId === item.uid ? '2px dashed #3498db' : '1px solid transparent',
                                        cursor: 'grab',
                                        zIndex: selectedId === item.uid ? 10 : 1, // Item aktif selalu di atas
                                        transition: isDragging ? 'none' : 'transform 0.2s', // Animasi rotasi halus
                                        display: 'flex',
                                        alignItems: 'center',
                                        justifyContent: 'center'
                                    }}
                                    title={item.name}
                                >
                                    {/* Render Gambar atau Kotak Warna */}
                                    {item.type === 'img' ? (
                                        <img 
                                            src={item.src} 
                                            alt={item.name} 
                                            style={{ 
                                                width: '100%', 
                                                height: '100%', 
                                                objectFit: 'contain', 
                                                pointerEvents: 'none' // Supaya gambar tidak ke-drag browser
                                            }} 
                                        />
                                    ) : (
                                        <div style={{
                                            width: '100%', height: '100%', 
                                            background: item.color, 
                                            opacity: 0.8,
                                            boxShadow: '2px 2px 5px rgba(0,0,0,0.2)'
                                        }}></div>
                                    )}
                                </div>
                            ))}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    );
}

if (document.getElementById('react-room-planner')) {
    createRoot(document.getElementById('react-room-planner')).render(<RoomPlanner />);
}
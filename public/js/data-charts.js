(function () {
    'use strict';
    const palette = ['#0f766e','#0891b2','#2563eb','#7c3aed','#db2777','#d97706','#10b981','#4f46e5'];
    function esc(value){return String(value??'').replace(/[&<>"']/g,m=>({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#039;'})[m]);}
    function mount(el,html){if(el)el.innerHTML=html;}

    // TOOLTIP SINGLETON (SUPER ELEGAN & MODERN WITH BACKDROP BLUR)
    function getTooltip() {
        let tooltip = document.getElementById('desacharts-tooltip');
        if (!tooltip) {
            tooltip = document.createElement('div');
            tooltip.id = 'desacharts-tooltip';
            tooltip.style.cssText = `
                position: fixed;
                display: none;
                pointer-events: none;
                z-index: 999999;
                background: rgba(15, 23, 42, 0.92);
                backdrop-filter: blur(10px);
                -webkit-backdrop-filter: blur(10px);
                color: #ffffff;
                padding: 10px 16px;
                border-radius: 14px;
                font-size: 13px;
                font-family: 'Inter', system-ui, sans-serif;
                box-shadow: 0 16px 35px rgba(15, 23, 42, 0.35);
                border: 1px solid rgba(255, 255, 255, 0.15);
                transition: opacity 0.15s ease, transform 0.15s ease;
                transform: translate(-50%, -125%);
                white-space: nowrap;
            `;
            document.body.appendChild(tooltip);
        }
        return tooltip;
    }

    function showTooltip(e, htmlContent) {
        const tooltip = getTooltip();
        tooltip.innerHTML = htmlContent;
        tooltip.style.display = 'block';
        tooltip.style.opacity = '1';
        tooltip.style.left = e.clientX + 'px';
        tooltip.style.top = e.clientY + 'px';
    }

    function moveTooltip(e) {
        const tooltip = getTooltip();
        tooltip.style.left = e.clientX + 'px';
        tooltip.style.top = (e.clientY - 12) + 'px';
    }

    function hideTooltip() {
        const tooltip = getTooltip();
        tooltip.style.opacity = '0';
        setTimeout(() => {
            if (tooltip.style.opacity === '0') tooltip.style.display = 'none';
        }, 150);
    }

    /**
     * 1. GRAFIK BATANG (BAR CHART) - TANPA PERSEN
     */
    function bar(el,labels,values,unit){
        if(!el)return;
        labels=labels||[];values=values||[];
        const max=Math.max(1,...values.map(Number));
        
        const rows=labels.map((label,i)=>{
            const value=Number(values[i]||0);
            const pct=Math.max(0,Math.min(100,value/max*100));
            const color = palette[i % palette.length];
            
            return `
            <div class="dc-bar-item" style="margin-bottom:14px;">
                <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:6px;font-size:13px;">
                    <span style="display:inline-flex;align-items:center;gap:8px;font-weight:750;color:#1e293b;">
                        <span style="width:10px;height:10px;border-radius:50%;background:${color};display:inline-block;"></span>
                        ${esc(label)}
                    </span>
                    <span style="font-weight:800;color:#0f172a;font-size:13px;">
                        ${value.toLocaleString('id-ID')} <small style="color:#64748b;font-weight:600;font-size:11px;">${unit ? esc(unit) : ''}</small>
                    </span>
                </div>
                <div class="dc-bar-shape" 
                     data-label="${esc(label)}" 
                     data-value="${value}" 
                     data-color="${color}" 
                     data-unit="${unit ? esc(unit) : ''}"
                     style="width:100%;height:14px;background:#f1f5f9;border-radius:999px;overflow:hidden;cursor:pointer;position:relative;transition:all 0.25s ease;">
                    <div class="dc-bar-fill" style="height:100%;width:${pct}%;background:${color};border-radius:999px;transition:width 0.8s cubic-bezier(0.34, 1.56, 0.64, 1);"></div>
                </div>
            </div>`;
        }).join('');
        
        mount(el,`<div class="dc-bars">${rows||'<div class="dc-empty" style="text-align:center;color:#94a3b8;padding:20px;font-weight:700;">Belum ada data.</div>'}</div>`);

        // Event Listener Pada Batang Diagram Warna
        const barShapes = el.querySelectorAll('.dc-bar-shape');
        barShapes.forEach(shape => {
            const label = shape.getAttribute('data-label');
            const val = Number(shape.getAttribute('data-value')).toLocaleString('id-ID');
            const color = shape.getAttribute('data-color');
            const unitText = shape.getAttribute('data-unit');
            const fill = shape.querySelector('.dc-bar-fill');

            shape.addEventListener('mouseenter', (e) => {
                shape.style.transform = 'scaleY(1.3)';
                shape.style.boxShadow = `0 4px 15px ${color}44`;
                if (fill) fill.style.filter = 'brightness(1.15)';

                showTooltip(e, `
                    <div style="display:flex;align-items:center;gap:8px;">
                        <span style="width:10px;height:10px;border-radius:50%;background:${color};"></span>
                        <span style="color:#ffffff;font-weight:800;font-size:13px;">${label}</span>
                    </div>
                    <div style="margin-top:4px;font-size:14px;color:#38bdf8;font-weight:900;">
                        ${val} ${unitText}
                    </div>
                `);
            });

            shape.addEventListener('mousemove', moveTooltip);

            shape.addEventListener('mouseleave', () => {
                shape.style.transform = 'scaleY(1)';
                shape.style.boxShadow = 'none';
                if (fill) fill.style.filter = 'none';
                hideTooltip();
            });
        });
    }

    /**
     * 2. GRAFIK LINGKARAN (DONUT CHART) - TANPA PERSEN
     */
    function donut(el,labels,values){
        if(!el)return;
        labels=labels||[];values=values||[];
        const total=values.reduce((a,b)=>a+Number(b||0),0),r=72,c=2*Math.PI*r;
        let offset=0;

        const circles=values.map((v,i)=>{
            const n=Number(v||0),len=total?n/total*c:0;
            const color = palette[i%palette.length];

            const html=`
                <circle class="dc-donut-slice" 
                        data-index="${i}" 
                        data-label="${esc(labels[i])}" 
                        data-value="${n}" 
                        data-color="${color}" 
                        cx="95" cy="95" r="${r}" 
                        fill="none" 
                        stroke="${color}" 
                        stroke-width="30" 
                        stroke-dasharray="${len} ${c-len}" 
                        stroke-dashoffset="${-offset}" 
                        style="transition:stroke-width 0.25s ease, filter 0.25s ease; cursor:pointer; pointer-events:stroke;"
                />`;
            offset+=len;
            return html;
        }).join('');

        const legend=labels.map((l,i)=>{
            const n = Number(values[i]||0);
            const color = palette[i%palette.length];
            return `
            <div class="dc-legend-item" data-index="${i}" style="display:flex;align-items:center;justify-content:space-between;padding:8px 12px;border-radius:12px;background:#f8fafc;border:1px solid #f1f5f9;font-size:12px;transition:all 0.2s ease;">
                <div style="display:flex;align-items:center;gap:8px;min-width:0;">
                    <span style="width:10px;height:10px;border-radius:4px;background:${color};flex-shrink:0;"></span>
                    <span style="font-weight:700;color:#334155;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">${esc(l)}</span>
                </div>
                <div style="text-align:right;margin-left:8px;flex-shrink:0;">
                    <strong style="font-weight:800;color:#0f172a;">${n.toLocaleString('id-ID')}</strong>
                </div>
            </div>`;
        }).join('');

        mount(el,`
            <div class="dc-donut-wrap" style="display:flex;flex-direction:column;align-items:center;gap:20px;width:100%;">
                <div class="dc-donut-container" style="position:relative;width:190px;height:190px;">
                    <svg viewBox="0 0 190 190" style="transform: rotate(-90deg); overflow:visible;">
                        ${circles}
                        <circle cx="95" cy="95" r="54" fill="white"/>
                    </svg>
                    <div class="dc-center-text" style="position:absolute;inset:0;display:flex;flex-direction:column;align-items:center;justify-content:center;text-align:center;pointer-events:none;padding:10px;">
                        <span id="dc-center-lbl" style="font-size:10px;font-weight:800;color:#64748b;letter-spacing:1px;text-transform:uppercase;margin-bottom:2px;max-width:110px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">TOTAL</span>
                        <strong id="dc-center-val" style="font-size:22px;font-weight:900;color:#0f172a;line-height:1.1;">${total.toLocaleString('id-ID')}</strong>
                    </div>
                </div>
                <div class="dc-legend" style="display:grid;grid-template-columns:repeat(2,1fr);gap:10px;width:100%;">
                    ${legend||'<div class="dc-empty" style="text-align:center;color:#94a3b8;grid-column:1/-1;">Belum ada data.</div>'}
                </div>
            </div>
        `);

        // Event Listener Khusus Pada Lingkaran Warna Diagram Donut
        const slices = el.querySelectorAll('.dc-donut-slice');
        const centerVal = el.querySelector('#dc-center-val');
        const centerLbl = el.querySelector('#dc-center-lbl');

        slices.forEach(slice => {
            const label = slice.getAttribute('data-label');
            const val = Number(slice.getAttribute('data-value')).toLocaleString('id-ID');
            const color = slice.getAttribute('data-color');

            slice.addEventListener('mouseenter', (e) => {
                slice.setAttribute('stroke-width', '40');
                slice.style.filter = `drop-shadow(0 0 10px ${color}aa)`;

                // Update Teks Tengah Diagram Secara Estetik
                if (centerVal && centerLbl) {
                    centerVal.textContent = val;
                    centerVal.style.color = color;
                    centerLbl.textContent = label;
                    centerLbl.style.color = color;
                }

                // Pop-up Keterangan Melayang Di Atas Diagram (Tanpa Persen)
                showTooltip(e, `
                    <div style="display:flex;align-items:center;gap:8px;">
                        <span style="width:10px;height:10px;border-radius:50%;background:${color};"></span>
                        <span style="color:#ffffff;font-weight:800;font-size:13px;">${label}</span>
                    </div>
                    <div style="margin-top:4px;font-size:14px;color:#38bdf8;font-weight:900;">
                        ${val}
                    </div>
                `);
            });

            slice.addEventListener('mousemove', moveTooltip);

            slice.addEventListener('mouseleave', () => {
                slice.setAttribute('stroke-width', '30');
                slice.style.filter = 'none';

                // Kembalikan Center Text ke Total
                if (centerVal && centerLbl) {
                    centerVal.textContent = total.toLocaleString('id-ID');
                    centerVal.style.color = '#0f172a';
                    centerLbl.textContent = 'TOTAL';
                    centerLbl.style.color = '#64748b';
                }

                hideTooltip();
            });
        });
    }

    /**
     * 3. GRAFIK TREN (LINE CHART) - TANPA PERSEN
     */
    function line(el,labels,values,datasets){
        if(!el)return;
        labels=labels||[];
        const series=datasets||[{label:'Nilai',values:values||[],color:palette[0]}],width=720,height=300,left=55,right=20,top=25,bottom=45,all=series.flatMap(s=>(s.values||[]).map(Number)),max=Math.max(1,...all);
        const x=i=>labels.length<=1?width/2:left+i*((width-left-right)/(labels.length-1));
        const y=v=>top+(height-top-bottom)-(Number(v||0)/max)*(height-top-bottom);

        let svg=`<svg class="dc-line-svg" viewBox="0 0 ${width} ${height}" preserveAspectRatio="none" style="overflow:visible;">`;
        for(let i=0;i<5;i++){const yy=top+i*((height-top-bottom)/4);svg+=`<line x1="${left}" y1="${yy}" x2="${width-right}" y2="${yy}" stroke="#f1f5f9" stroke-dasharray="4"/>`}
        labels.forEach((l,i)=>svg+=`<text x="${x(i)}" y="${height-12}" text-anchor="middle" fill="#64748b" font-size="11" font-weight="700">${esc(l)}</text>`);
        
        series.forEach((s,si)=>{
            const color=s.color||palette[si%palette.length],pts=(s.values||[]).map((v,i)=>`${x(i)},${y(v)}`).join(' ');
            svg+=`<polyline points="${pts}" fill="none" stroke="${color}" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/>`;
            
            (s.values||[]).forEach((v,i)=> {
                svg+=`
                <circle class="dc-line-point" 
                        data-series="${esc(s.label)}" 
                        data-label="${esc(labels[i])}" 
                        data-value="${v}" 
                        data-color="${color}" 
                        cx="${x(i)}" cy="${y(v)}" r="7" 
                        fill="${color}" 
                        stroke="#ffffff" 
                        stroke-width="3" 
                        style="cursor:pointer; transition:all 0.25s ease;"
                />`;
            });
        });
        
        svg+='</svg>';
        const legend=series.map((s,i)=>`
            <span class="dc-line-legend" style="display:inline-flex;align-items:center;gap:6px;font-size:12px;font-weight:700;color:#334155;background:#f8fafc;padding:5px 12px;border-radius:999px;border:1px solid #e2e8f0;">
                <i style="width:8px;height:8px;border-radius:50%;background:${s.color||palette[i%palette.length]};display:inline-block;"></i>
                ${esc(s.label)}
            </span>
        `).join('');
        mount(el,svg+`<div class="dc-line-legends" style="margin-top:12px;display:flex;justify-content:center;gap:10px;">${legend}</div>`);

        // Event Listener Khusus Pada Titik Diagram Garis
        const points = el.querySelectorAll('.dc-line-point');
        points.forEach(pt => {
            const sLabel = pt.getAttribute('data-series');
            const label = pt.getAttribute('data-label');
            const val = Number(pt.getAttribute('data-value')).toLocaleString('id-ID');
            const color = pt.getAttribute('data-color');

            pt.addEventListener('mouseenter', (e) => {
                pt.setAttribute('r', '11');
                pt.style.filter = `drop-shadow(0 0 8px ${color})`;

                showTooltip(e, `
                    <div style="display:flex;align-items:center;gap:6px;">
                        <span style="width:8px;height:8px;border-radius:50%;background:${color};"></span>
                        <span style="font-size:12px;color:#cbd5e1;font-weight:700;">${sLabel} (${label})</span>
                    </div>
                    <div style="font-size:15px;color:#ffffff;font-weight:900;margin-top:3px;">
                        <span style="color:#38bdf8;">${val} jiwa</span>
                    </div>
                `);
            });

            pt.addEventListener('mousemove', moveTooltip);

            pt.addEventListener('mouseleave', () => {
                pt.setAttribute('r', '7');
                pt.style.filter = 'none';
                hideTooltip();
            });
        });
    }

    window.DesaCharts={bar,donut,line};
})();
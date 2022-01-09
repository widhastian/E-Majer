package com.pina.emajer_v2.Model.CatatanPengeluaran;

import java.util.List;

public class DataPengeluaranResponse {
    private int kode;
    private String pesan;
    private List<DataPengeluaran> data;
    private List<DataPengeluaranDetail> dataPengeluaranDetail;


    public int getKode() {
        return kode;
    }

    public void setKode(int kode) {
        this.kode = kode;
    }


    public String getPesan() {
        return pesan;
    }

    public void setPesan(String pesan) {
        this.pesan = pesan;
    }

    public List<DataPengeluaran> getData() {
        return data;
    }

    public void setData(List<DataPengeluaran> data) {
        this.data = data;
    }

    public List<DataPengeluaranDetail> getDataPengeluaranDetail() {
        return dataPengeluaranDetail;
    }

    public void setDataPengeluaranDetail(List<DataPengeluaranDetail> dataPengeluaranDetail) {
        this.dataPengeluaranDetail = dataPengeluaranDetail;
    }
}

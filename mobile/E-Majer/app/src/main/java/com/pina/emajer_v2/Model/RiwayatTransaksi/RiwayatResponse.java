package com.pina.emajer_v2.Model.RiwayatTransaksi;

import java.util.List;

public class RiwayatResponse {

    private int kode;
    private String message;
    private List<RiwayatAll> riwayatAll;

    public int getKode() {
        return kode;
    }

    public void setKode(int status) {
        this.kode = status;
    }

    public String getMessage() {
        return message;
    }

    public void setMessage(String message) {
        this.message = message;
    }

    public List<RiwayatAll> getRiwayatAll() {
        return riwayatAll;
    }

    public void setRiwayatAll(List<RiwayatAll> riwayatAll) {
        this.riwayatAll = riwayatAll;
    }
}
